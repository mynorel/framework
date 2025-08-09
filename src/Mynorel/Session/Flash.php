<?php
namespace Mynorel\Session;

/**
 * Flash: Helper for session-based flash messages in Mynorel.
 * For CLI, templates, and web output.
 */
class Flash
{
    /**
     * Set a flash message.
     */
    public static function set(string $key, $value): void
    {
        Session::flash($key, $value);
    }

    /**
     * Get and remove a flash message.
     */
    public static function get(string $key, $default = null)
    {
        return Session::recallFlash($key, $default);
    }

    /**
     * Peek at a flash message (without removing).
     */
    public static function peek(string $key, $default = null)
    {
        return Session::recall('__flash__.' . $key, $default);
    }

    /**
     * Check if a flash message exists.
     */
    public static function has(string $key): bool
    {
        return Session::recall('__flash__.' . $key) !== null;
    }

    /**
     * Clear all flash messages.
     */
    public static function clear(): void
    {
        $all = Session::all();
        foreach ($all['__flash__'] ?? [] as $key => $_) {
            Session::forget('__flash__.' . $key);
        }
    }
}
