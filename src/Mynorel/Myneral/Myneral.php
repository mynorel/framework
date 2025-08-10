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
     * Clear all registered directives (for testing).
     */
    public static function clearDirectives(): void
    {
        self::$directives = [];
    }

    /**
     * Get all registered directives (for validation).
     * @return array<string, \Mynorel\Myneral\Directives\BaseDirective>
     */
    public static function getDirectives(): array
    {
        return self::$directives;
    }
    /**
     * Registered directives.
     * @var array<string, \Mynorel\Myneral\Directives\BaseDirective>
     */
    protected static array $directives = [];

    /**
     * Register a directive class.
     * @param string $name
     * @param \Mynorel\Myneral\Directives\BaseDirective $directive
     */
    public static function registerDirective(string $name, BaseDirective $directive): void
    {
        $key = strtolower(trim($name));
        self::$directives[$key] = $directive;
        if (class_exists('Mynorel\\Facades\\Chronicle', false)) {
            try {
                Chronicle::note("Directive @$key registered.");
            } catch (\Throwable $e) {}
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
        self::registerDirective('lang', new \Mynorel\Myneral\Directives\LangDirective());
        self::registerDirective('asset', new \Mynorel\Myneral\Directives\AssetDirective());
        self::registerDirective('component', new \Mynorel\Myneral\Directives\ComponentDirective());
        self::registerDirective('can', new CanDirective());
        self::registerDirective('role', new RoleDirective());
        self::registerDirective('csrf', new \Mynorel\Myneral\Directives\CsrfDirective());
        self::registerDirective('flash', new \Mynorel\Myneral\Directives\FlashDirective());
        self::registerDirective('auth', new \Mynorel\Myneral\Directives\AuthDirective());
        self::registerDirective('section', new \Mynorel\Myneral\Directives\SectionDirective());
        self::registerDirective('yield', new \Mynorel\Myneral\Directives\YieldDirective());
        self::registerDirective('extends', new \Mynorel\Myneral\Directives\ExtendsDirective());
    }

    /**
     * Parse and compile a Myneral template string.
     * @param string $template
     * @param array $context
     * @return string Compiled PHP
     */
    public static function compile(string $template, array $context = [], ?string $templatePath = null): string
    {
        // View cache directory
        $cacheDir = __DIR__ . '/../../../cache/views/';
        if (!is_dir($cacheDir)) @mkdir($cacheDir, 0777, true);
        $cacheKey = $templatePath ? md5($templatePath) : md5($template);
        $cacheFile = $cacheDir . $cacheKey . '.php';
        $templateMTime = $templatePath && file_exists($templatePath) ? filemtime($templatePath) : null;
        // Use cache if available and up-to-date
        if (file_exists($cacheFile) && (!$templateMTime || filemtime($cacheFile) >= $templateMTime)) {
            return file_get_contents($cacheFile);
        }
        $tokens = Grammar::parse($template);
        $output = '';
        $stack = [];
        $currentBlock = null;
        foreach ($tokens as $token) {
            $line = $token['line'] ?? null;
            if (isset($token['type']) && $token['type'] === 'error') {
                foreach ($token['errors'] as $err) {
                    $msg = $line ? "Error (line $line): $err" : "Error: $err";
                    if (class_exists('Mynorel\\Facades\\Chronicle', false)) {
                        try { Chronicle::warn($msg); } catch (\Throwable $e) {}
                    }
                    $output .= "<!-- $msg -->";
                }
                continue;
            }
            if (isset($token['type']) && $token['type'] === 'text') {
                $output .= $token['content'];
                continue;
            }
            if (isset($token['type']) && $token['type'] === 'block_start') {
                $name = isset($token['directive']) ? strtolower(trim($token['directive'])) : null;
                $args = $token['args'] ?? [];
                $currentBlock = [
                    'name' => $name,
                    'args' => $args,
                    'content' => '',
                    'line' => $line,
                ];
                $stack[] = $currentBlock;
                continue;
            }
            if (isset($token['type']) && $token['type'] === 'directive') {
                $name = isset($token['directive']) ? strtolower(trim($token['directive'])) : null;
                $args = $token['args'] ?? [];
                if (class_exists('Mynorel\\Facades\\Prelude') && method_exists('Mynorel\\Facades\\Prelude', 'runForDirective')) {
                    \Mynorel\Facades\Prelude::runForDirective($name, $context);
                }
                if (isset(self::$directives[$name])) {
                    try {
                        $compiled = self::$directives[$name]->compile($args, $context);
                        if (class_exists('Mynorel\\Facades\\Chronicle', false)) {
                            try { Chronicle::note("Compiled @$name directive" . ($line ? " (line $line)" : '')); } catch (\Throwable $e) {}
                        }
                        if (!empty($stack)) {
                            $stack[count($stack)-1]['content'] .= $compiled;
                        } else {
                            $output .= $compiled;
                        }
                    } catch (\Throwable $e) {
                        $errMsg = $line ? "<!-- Error in @$name (line $line): {$e->getMessage()} -->" : "<!-- Error in @$name: {$e->getMessage()} -->";
                        if (class_exists('Mynorel\\Facades\\Chronicle', false)) {
                            try { Chronicle::warn($errMsg); } catch (\Throwable $e) {}
                        }
                        if (!empty($stack)) {
                            $stack[count($stack)-1]['content'] .= $errMsg;
                        } else {
                            $output .= $errMsg;
                        }
                    }
                } else {
                    $errMsg = $line ? "<!-- Unknown directive: @$name (line $line) -->" : "<!-- Unknown directive: @$name -->";
                    if (!empty($stack)) {
                        $stack[count($stack)-1]['content'] .= $errMsg;
                    } else {
                        $output .= $errMsg;
                    }
                }
                continue;
            }
            if (isset($token['type']) && $token['type'] === 'block_end') {
                $block = array_pop($stack);
                $name = $block['name'];
                $args = $block['args'];
                $content = $block['content'];
                $blockLine = $block['line'] ?? null;
                if (isset(self::$directives[$name])) {
                    self::$directives[$name]->setContent($content);
                    try {
                        $compiled = self::$directives[$name]->compile($args, $context);
                        if (class_exists('Mynorel\\Facades\\Chronicle', false)) {
                            try { Chronicle::note("Compiled block @$name directive (line $blockLine)"); } catch (\Throwable $e) {}
                        }
                        if (!empty($stack)) {
                            $stack[count($stack)-1]['content'] .= $compiled;
                        } else {
                            $output .= $compiled;
                        }
                    } catch (\Throwable $e) {
                        $errMsg = $blockLine ? "<!-- Error in block @$name (line $blockLine): {$e->getMessage()} -->" : "<!-- Error in block @$name: {$e->getMessage()} -->";
                        if (class_exists('Mynorel\\Facades\\Chronicle', false)) {
                            try { Chronicle::warn($errMsg); } catch (\Throwable $e) {}
                        }
                        if (!empty($stack)) {
                            $stack[count($stack)-1]['content'] .= $errMsg;
                        } else {
                            $output .= $errMsg;
                        }
                    }
                } else {
                    $errMsg = $blockLine ? "<!-- Unknown block directive: @$name (line $blockLine) -->" : "<!-- Unknown block directive: @$name -->";
                    if (!empty($stack)) {
                        $stack[count($stack)-1]['content'] .= $errMsg;
                    } else {
                        $output .= $errMsg;
                    }
                }
                continue;
            }
        }
        // Save to cache
        file_put_contents($cacheFile, $output);
        return $output;
    }

    /**
     * Render a Myneral template with context, flows, and layouts.
     * @param string $template
     * @param array $context
     * @return string
     */
    public static function render(string $template, array $context = [], ?string $templatePath = null): string
    {
        // Parse for @flow and @layout
        $tokens = Grammar::parse($template);
        $flow = null;
        $layout = null;
        foreach ($tokens as $token) {
            if (($token['directive'] ?? null) === 'flow') {
                $flow = class_exists('Mynorel\\Myneral\\Flows\\FlowManager') ? FlowManager::get($token['args']) : null;
            }
            if (($token['directive'] ?? null) === 'layout') {
                $layout = class_exists('Mynorel\\Myneral\\Layouts\\LayoutManager') ? LayoutManager::get($token['args']) : null;
            }
        }
        // Compile template
        $compiled = self::compile($template, $context, $templatePath);
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
        if (class_exists('Mynorel\\Facades\\Chronicle', false)) {
            try { Chronicle::chapter("Flow applied."); } catch (\Throwable $e) {}
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
        if (class_exists('Mynorel\\Facades\\Chronicle', false)) {
            try { Chronicle::chapter("Layout applied."); } catch (\Throwable $e) {}
        }
        return $output;
    }
}
