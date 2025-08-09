<?php
namespace Mynorel\Console\Output;

/**
 * SyntaxColorizer: Adds color to code and meta output for CLI.
 */
class SyntaxColorizer
{
    /**
     * Colorize a string for CLI output.
     * Supports: keyword, string, number, comment, default.
     *
     * @param string $text
     * @param string $type
     * @return string
     */
    public static function color(string $text, string $type = 'default'): string
    {
        $colors = [
            'keyword' => "\033[1;36m",   // cyan bold
            'string'  => "\033[0;32m",   // green
            'number'  => "\033[1;33m",   // yellow bold
            'comment' => "\033[0;90m",   // gray
            'module'  => "\033[1;35m",   // magenta bold
            'philosophy' => "\033[1;34m", // blue bold
            'default' => "\033[0m"
        ];
        $reset = "\033[0m";
        $color = $colors[$type] ?? $colors['default'];
        return $color . $text . $reset;
    }

    /**
     * Colorize code-like output (simple PHP highlighting).
     *
     * @param string $line
     * @return string
     */
    public static function colorizeCode(string $line): string
    {
        // Highlight PHP keywords
        $keywords = ['namespace', 'class', 'public', 'protected', 'private', 'function', 'use', 'return', 'static', 'new', 'as', 'if', 'else', 'foreach', 'for', 'while', 'switch', 'case', 'default', 'echo'];
        foreach ($keywords as $kw) {
            $line = preg_replace('/\\b' . $kw . '\\b/', self::color($kw, 'keyword'), $line);
        }
        // Strings
        $line = preg_replace('/("[^"]*"|\'[^"]*\')/', self::color('$1', 'string'), $line);
        // Numbers
        $line = preg_replace('/\b(\d+)\b/', self::color('$1', 'number'), $line);
        // Comments
        $line = preg_replace('/(\/\/.*|#.*)/', self::color('$1', 'comment'), $line);
        return $line;
    }
}
