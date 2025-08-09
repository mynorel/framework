<?php
namespace Mynorel\MemoryPalace;

/**
 * MemoryPalace: Narrative cache layer for Mynorel.
 * Store, recall, and forget fragments of your story.
 */
class MemoryPalace
{
    protected static array $cache = [];

    /**
     * Inscribe (store) a value in the palace.
     */
    public static function inscribe(string $key, $value, int $ttl = 0): void
    {
        self::$cache[$key] = [
            'value' => $value,
            'expires' => $ttl > 0 ? time() + $ttl : null
        ];
    }

    /**
     * Recall (retrieve) a value from the palace.
     */
    public static function recall(string $key, $default = null)
    {
        if (!isset(self::$cache[$key])) return $default;
        $entry = self::$cache[$key];
        if ($entry['expires'] && $entry['expires'] < time()) {
            unset(self::$cache[$key]);
            return $default;
        }
        return $entry['value'];
    }

    /**
     * Forget a value from the palace.
     */
    public static function forget(string $key): void
    {
        unset(self::$cache[$key]);
    }

    /**
     * Clear the entire palace.
     */
    public static function clear(): void
    {
        self::$cache = [];
    }
}
