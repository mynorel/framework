<?php
namespace Mynorel\Myneral;

class Helpers
{
    /**
     * Find and return the path to a .myneral.php template by name.
     * Looks in resources/views/ by default.
     * Example: findTemplate('welcome') => resources/views/welcome.myneral.php
     */
    public static function findTemplate(string $name, array $paths = []): ?string
    {
        $searchPaths = $paths ?: [
            __DIR__ . '/../../../resources/views/',
            getcwd() . '/resources/views/',
        ];
        foreach ($searchPaths as $dir) {
            $file = rtrim($dir, '/\\') . '/' . ltrim($name, '/\\') . '.myneral.php';
            if (file_exists($file)) {
                return $file;
            }
        }
        return null;
    }
    /**
     * Escape HTML for output (like Blade's e()).
     */
    public static function escape($value): string
    {
        return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }

    /**
     * Escape for JS context.
     */
    public static function escapeJs($value): string
    {
        // Simple JS escape (for demonstration)
        return str_replace(['"', "'", "\n", "\r", "\u2028", "\u2029"], ['\\"', "\\'", "\\n", "\\r", "\\u2028", "\\u2029"], addslashes($value));
    }

    /**
     * Escape for HTML attribute context.
     */
    public static function escapeAttr($value): string
    {
        return htmlspecialchars($value, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }
}
