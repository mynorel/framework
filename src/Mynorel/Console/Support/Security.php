<?php
namespace Mynorel\Console\Support;

/**
 * Security: Input sanitization and file operation helpers for CLI security.
 */
class Security
{
    /**
     * Sanitize CLI input (basic).
     */
    public static function sanitizeInput(string $input): string
    {
        // Remove dangerous shell characters and trim
        return trim(preg_replace('/[;&|`$<>]/', '', $input));
    }

    /**
     * Restrict file operations to project directory.
     */
    public static function isSafePath(string $path): bool
    {
        $real = realpath($path);
        $base = realpath(getcwd());
        return $real && strpos($real, $base) === 0;
    }
}
