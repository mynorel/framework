<?php
namespace Mynorel\Console\Output;

/**
 * StylizedPrinter: Handles narrative and styled output for the Mynorel CLI.
 */

use Mynorel\Console\Output\SyntaxColorizer;

class StylizedPrinter
{
    public static function print(string $message, string $style = 'default'): void
    {
        // Add color for certain styles
        if ($style === 'module') {
            $message = SyntaxColorizer::color($message, 'module');
        } elseif ($style === 'philosophy') {
            $message = SyntaxColorizer::color($message, 'philosophy');
        }
        echo $message . "\n";
    }

    public static function poetic(string $message): void
    {
        self::print("🌱 $message", 'poetic');
    }

    public static function info(string $message): void
    {
        self::print("→ $message", 'info');
    }

    public static function warn(string $message): void
    {
        self::print("[warn] $message", 'warn');
    }

    public static function error(string $message): void
    {
        self::print("[error] $message", 'error');
    }

    /**
     * Print a colorized string using SyntaxColorizer directly.
     */
    public static function colorize(string $message, string $type = 'default'): void
    {
        echo SyntaxColorizer::color($message, $type) . "\n";
    }
}
