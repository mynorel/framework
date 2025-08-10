<?php
namespace Mynorel\Myneral;

use Mynorel\Myneral\DSL\Grammar;
use Mynorel\Myneral\Directives\BaseDirective;
use Mynorel\Myneral\Directives\CanDirective;
use Mynorel\Myneral\Directives\RoleDirective;
use Mynorel\Myneral\Flows\FlowManager;
use Mynorel\Myneral\Layouts\LayoutManager;
use Mynorel\Facades\Chronicle;

class Myneral {
    /**
     * Registered directives.
     * @var array<string, \Mynorel\Myneral\Directives\BaseDirective>
     */
    protected static array $directives = [];

    public static function clearDirectives(): void {
        self::$directives = [];
    }

    public static function getDirectives(): array {
        return self::$directives;
    }

    public static function registerDirective(string $name, BaseDirective $directive): void {
        $key = strtolower(trim($name));
        self::$directives[$key] = $directive;
        if (class_exists('Mynorel\\Facades\\Chronicle', false)) {
            try {
                Chronicle::note("Directive @$key registered.");
            } catch (\Throwable $e) {}
        }
    }

    public static function registerDirectives(array $map): void {
        foreach ($map as $name => $directive) {
            self::registerDirective($name, $directive);
        }
    }

    public static function registerDefaults(): void {
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
    self::registerDirective('note', new \Mynorel\Myneral\Directives\NoteDirective());
    self::registerDirective('flow', new \Mynorel\Myneral\Directives\FlowDirective());
    self::registerDirective('if', new \Mynorel\Myneral\Directives\IfDirective());
    self::registerDirective('show', new \Mynorel\Myneral\Directives\ShowDirective());
    // Register test layout and flow for demonstration
    LayoutManager::registerTestLayouts();
    FlowManager::registerTestFlows();
    }

    /**
     * Compile a Myneral template string.
     */
    public static function compile(string $template, array $context = [], ?string $templatePath = null): string {
        try {
            // 1. Dot notation: Convert foo.bar to $foo->bar (but not inside PHP tags)
            $template = preg_replace_callback(
                '/\{{2,3}\s*([a-zA-Z_][a-zA-Z0-9_]*(?:\.[a-zA-Z0-9_]+)+)\s*\}{2,3}/',
                function ($matches) {
                    $expr = $matches[1];
                    $php = preg_replace('/([a-zA-Z_][a-zA-Z0-9_]*)\.([a-zA-Z0-9_]+)/', '$1->$2', $expr);
                    $delims = substr($matches[0], 0, 3) === '{{{' ? ['{{{', '}}}'] : ['{{', '}}'];
                    return $delims[0] . ' ' . $php . ' ' . $delims[1];
                },
                $template
            );

            // 2. Compile registered directives (inline only, e.g. @lang, @asset)
            $template = preg_replace_callback(
                '/@(\w+)\(([^)]*)\)/',
                function ($matches) use ($context) {
                    $name = strtolower($matches[1]);
                    $args = array_map(function($v) {
                        $v = trim($v);
                        return trim($v, "'\"");
                    }, str_getcsv($matches[2]));
                    $directives = self::getDirectives();
                    if (isset($directives[$name])) {
                        try {
                            return $directives[$name]->compile($args, $context);
                        } catch (\Throwable $e) {
                            return '<!-- Mynorel directive error: ' . htmlspecialchars($e->getMessage()) . ' -->';
                        }
                    }
                    return '<!-- Unknown directive: @' . $name . ' -->' . $matches[0];
                },
                $template
            );

            // 3. Replace escaped output: {{{ ... }}} (raw, unescaped)
            $template = preg_replace_callback(
                '/\{{3}\s*(.+?)\s*\}{3}/s',
                function ($matches) {
                    return '<?php echo ' . $matches[1] . '; ?>';
                },
                $template
            );

            // 4. Replace normal output: {{ ... }} (escaped)
            $template = preg_replace_callback(
                '/\{{2}\s*(.+?)\s*\}{2}/s',
                function ($matches) {
                    return '<?php echo \\Mynorel\\Myneral\\Helpers::escape(' . $matches[1] . '); ?>';
                },
                $template
            );

            // 5. Compile PHP tags
            $template = preg_replace('/@php(.*?)@endphp/s', '<?php$1?>', $template);

            // 6. Error handling: annotate unknown directives (block only)
            $template = preg_replace_callback(
                '/@(\w+)/',
                function ($matches) {
                    $known = [
                        'if', 'elseif', 'else', 'endif', 'foreach', 'endforeach', 'for', 'endfor', 'while', 'endwhile',
                        'section', 'endsection', 'yield', 'extends', 'include', 'php', 'endphp', 'verbatim', 'endverbatim',
                        // Add more as needed
                    ];
                    if (!in_array($matches[1], $known)) {
                        return '<!-- Unknown directive: @' . $matches[1] . ' -->';
                    }
                    return $matches[0];
                },
                $template
            );

            // 7. Context isolation and error handler as a single PHP block
            // Only wrap with PHP context block if PHP code is present
            if (strpos($template, '<?php') !== false) {
                $contextVars = array_keys($context);
                $contextCode = '';
                foreach ($contextVars as $var) {
                    if (preg_match('/^[a-zA-Z_][a-zA-Z0-9_]*$/', $var)) {
                        $contextCode .= '$' . $var . ' = $context["' . $var . '"] ?? null;\n';
                    }
                }
                $compiled = "<?php\n// Context isolation\n" . $contextCode . "set_error_handler(function(\n    \$errno, \$errstr, \$errfile, \$errline\n) {\n    echo '<!-- Mynorel error: ' . htmlspecialchars((string)\$errstr) . ' in ' . htmlspecialchars((string)\$errfile) . ' on line ' . \$errline . ' -->';\n    return true;\n});\n?>\n" . $template . "<?php restore_error_handler(); ?>";
                return $compiled;
            } else {
                // Fully resolved, return as-is
                return $template;
            }
        } catch (\Throwable $e) {
            return '<!-- Mynorel compile error: ' . htmlspecialchars($e->getMessage()) . ' -->';
        }
    }

    /**
     * Render a Myneral template with context, flows, and layouts.
     * Automatically applies layout (@layout/@extends) and flow (@flow) if present.
     */
    public static function render(string $template, array $context = [], ?string $templatePath = null): string {
        // 1. Detect layout directive (e.g., @layout('main') or @extends('main'))
        $layout = null;
        if (preg_match("/@(?:layout|extends)\\(['\"]([^'\"]+)['\"]\\)/", $template, $m)) {
            $layout = $m[1];
            $template = preg_replace("/@(?:layout|extends)\\(['\"]([^'\"]+)['\"]\\)/", '', $template, 1);
        }

        // 2. Detect flow directive (e.g., @flow('onboarding'))
        $flow = null;
        if (preg_match("/@flow\\(['\"]([^'\"]+)['\"]\\)/", $template, $m)) {
            $flow = $m[1];
            $template = preg_replace("/@flow\\(['\"]([^'\"]+)['\"]\\)/", '', $template, 1);
        }

        // 3. Compile the template
        $compiled = self::compile($template, $context, $templatePath);

        // 4. Apply flow logic if needed
        if ($flow) {
            $flowObj = FlowManager::get($flow);
            if ($flowObj && method_exists($flowObj, 'apply')) {
                $compiled = $flowObj->apply($compiled, $context);
            } else {
                $compiled = "<!-- Flow: $flow not found or not applicable -->\n" . $compiled;
            }
        }

        // 5. Apply layout if needed
        if ($layout) {
            $layoutObj = LayoutManager::get($layout);
            if ($layoutObj && method_exists($layoutObj, 'wrap')) {
                $compiled = $layoutObj->wrap($compiled, $context);
            } else {
                $compiled = "<!-- Layout: $layout not found or not applicable -->\n" . $compiled;
            }
        }

        return $compiled;
    }

    /**
     * Apply a layout to compiled content.
     */
    public static function applyLayout(string $compiled, $layout, array $context): string {
        $output = '';
        if ($layout && method_exists($layout, 'sections')) {
            $sections = $layout->sections();
            $output = (isset($sections['header']) ? $sections['header'] : '');
            $output .= $compiled;
            $output .= (isset($sections['footer']) ? $sections['footer'] : '');
        } else {
            $output = $compiled;
        }
        if (class_exists('Mynorel\\Facades\\Chronicle', false)) {
            try { Chronicle::chapter("Layout applied."); } catch (\Throwable $e) {}
        }
        return $output;
    }
}
        $output = '';
