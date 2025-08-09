<?php
namespace Mynorel\Myneral;

use Mynorel\Myneral\DSL\Grammar;
use Mynorel\Myneral\Directives\BaseDirective;
use Mynorel\Myneral\Directives\CanDirective;
use Mynorel\Myneral\Directives\RoleDirective;
use Mynorel\Myneral\Flows\FlowManager;
use Mynorel\Myneral\Layouts\LayoutManager;
use Mynorel\Facades\Chronicle;
// Prelude, Author, Theme, Manifest, Narrative facades assumed available

/**
 * Myneral: The expressive engine for parsing, compiling, and rendering narrative templates.
 */
class Myneral
{
    /**
     * Get all registered directives (for validation).
     * @return array<string, BaseDirective>
     */
    public static function getDirectives(): array
    {
        return self::$directives;
    }
    /**
     * Registered directives.
     * @var array<string, BaseDirective>
     */
    protected static array $directives = [];

    /**
     * Register a directive class.
     * @param string $name
     * @param BaseDirective $directive
     */
    public static function registerDirective(string $name, BaseDirective $directive): void
    {
        self::$directives[$name] = $directive;
        if (class_exists('Mynorel\\Facades\\Chronicle')) {
            Chronicle::note("Directive @$name registered.");
        }
    }

    /**
     * Register multiple directives at once.
     * @param array $map [name => BaseDirective]
     */
    public static function registerDirectives(array $map): void
    {
        foreach ($map as $name => $directive) {
            self::registerDirective($name, $directive);
        }
    }

    /**
     * Register default built-in directives (including Author integration).
     */
    public static function registerDefaults(): void
    {
        self::registerDirective('can', new CanDirective());
        self::registerDirective('role', new RoleDirective());
        // ...register other built-in directives as needed...
    }

    /**
     * Parse and compile a Myneral template string.
     * @param string $template
     * @param array $context
     * @return string Compiled PHP
     */
    public static function compile(string $template, array $context = []): string
    {
        $tokens = Grammar::parse($template);
        $output = '';
        $stack = [];
        $currentBlock = null;
        foreach ($tokens as $token) {
            if (isset($token['type']) && $token['type'] === 'error') {
                foreach ($token['errors'] as $err) {
                    if (class_exists('Mynorel\\Facades\\Chronicle')) {
                        Chronicle::warn($err);
                    }
                    $output .= "<!-- Error: $err -->";
                }
                continue;
            }
            if (isset($token['type']) && $token['type'] === 'text') {
                $output .= $token['content'];
                continue;
            }
            if (isset($token['type']) && $token['type'] === 'block_start') {
                $currentBlock = [
                    'name' => $token['directive'],
                    'args' => $token['args'],
                    'content' => '',
                ];
                $stack[] = $currentBlock;
                continue;
            }
            if (isset($token['type']) && $token['type'] === 'block_end') {
                $block = array_pop($stack);
                $name = $block['name'];
                $args = [$block['args']];
                $content = $block['content'];
                if (isset(self::$directives[$name])) {
                    self::$directives[$name]->setContent($content);
                    try {
                        $compiled = self::$directives[$name]->compile($args, $context);
                        if (class_exists('Mynorel\\Facades\\Chronicle')) {
                            Chronicle::note("Compiled block @$name directive.");
                        }
                        if (!empty($stack)) {
                            $stack[count($stack)-1]['content'] .= $compiled;
                        } else {
                            $output .= $compiled;
                        }
                    } catch (\Throwable $e) {
                        if (class_exists('Mynorel\\Facades\\Chronicle')) {
                            Chronicle::warn("Error compiling block @$name: " . $e->getMessage());
                        }
                        $errMsg = "<!-- Error in block @$name: {$e->getMessage()} -->";
                        if (!empty($stack)) {
                            $stack[count($stack)-1]['content'] .= $errMsg;
                        } else {
                            $output .= $errMsg;
                        }
                    }
                } else {
                    $errMsg = "<!-- Unknown block directive: @$name -->";
                    if (!empty($stack)) {
                        $stack[count($stack)-1]['content'] .= $errMsg;
                    } else {
                        $output .= $errMsg;
                    }
                }
                continue;
            }
            // Inline directive
            $name = $token['directive'] ?? null;
            $args = $token['args'] ?? null;
            if (class_exists('Mynorel\\Facades\\Prelude') && method_exists('Mynorel\\Facades\\Prelude', 'runForDirective')) {
                \Mynorel\Facades\Prelude::runForDirective($name, $context);
            }
            if (isset(self::$directives[$name])) {
                try {
                    $compiled = self::$directives[$name]->compile($args, $context);
                    if (class_exists('Mynorel\\Facades\\Chronicle')) {
                        Chronicle::note("Compiled @$name directive.");
                    }
                    if (!empty($stack)) {
                        $stack[count($stack)-1]['content'] .= $compiled;
                    } else {
                        $output .= $compiled;
                    }
                } catch (\Throwable $e) {
                    if (class_exists('Mynorel\\Facades\\Chronicle')) {
                        Chronicle::warn("Error compiling @$name: " . $e->getMessage());
                    }
                    $errMsg = "<!-- Error in @$name: {$e->getMessage()} -->";
                    if (!empty($stack)) {
                        $stack[count($stack)-1]['content'] .= $errMsg;
                    } else {
                        $output .= $errMsg;
                    }
                }
            } else {
                $errMsg = "<!-- Unknown directive: @$name -->";
                if (!empty($stack)) {
                    $stack[count($stack)-1]['content'] .= $errMsg;
                } else {
                    $output .= $errMsg;
                }
            }
        }
        return $output;
    }

    /**
     * Render a Myneral template with context, flows, and layouts.
     * @param string $template
     * @param array $context
     * @return string
     */
    public static function render(string $template, array $context = []): string
    {
        // Parse for @flow and @layout
        $tokens = Grammar::parse($template);
        $flow = null;
        $layout = null;
        foreach ($tokens as $token) {
            if ($token['directive'] === 'flow') {
                $flow = class_exists('Mynorel\\Myneral\\Flows\\FlowManager') ? FlowManager::get($token['args']) : null;
            }
            if ($token['directive'] === 'layout') {
                $layout = class_exists('Mynorel\\Myneral\\Layouts\\LayoutManager') ? LayoutManager::get($token['args']) : null;
            }
        }
        // Compile template
        $compiled = self::compile($template, $context);
        // Apply flow (if any)
        if ($flow) {
            $compiled = self::applyFlow($compiled, $flow, $context);
        }
        // Apply layout (if any)
        if ($layout) {
            $compiled = self::applyLayout($compiled, $layout, $context);
        }
        return $compiled;
    }

    /**
     * Apply a flow to compiled content.
     * @param string $compiled
     * @param $flow
     * @param array $context
     * @return string
     */
    protected static function applyFlow(string $compiled, $flow, array $context): string
    {
        // For each directive in the flow, run it (could be pre/post hooks)
        foreach ($flow->sequence() as $directiveName) {
            if (isset(self::$directives[$directiveName])) {
                $compiled = self::$directives[$directiveName]->compile($compiled, $context);
            }
        }
        if (class_exists('Mynorel\\Facades\\Chronicle')) {
            Chronicle::chapter("Flow applied.");
        }
        return $compiled;
    }

    /**
     * Apply a layout to compiled content.
     * @param string $compiled
     * @param $layout
     * @param array $context
     * @return string
     */
    protected static function applyLayout(string $compiled, $layout, array $context): string
    {
        // Insert compiled content into layout sections
        $sections = $layout->sections();
        $output = $sections['header'] ?? '';
        $output .= $compiled;
        $output .= $sections['footer'] ?? '';
        if (class_exists('Mynorel\\Facades\\Chronicle')) {
            Chronicle::chapter("Layout applied.");
        }
        return $output;
    }
}
