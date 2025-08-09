<?php
namespace Mynorel\Facades;

use Mynorel\Scriptorium\Scriptorium;

/**
 * MemoryPalace: Facade for narrative cache.
 */
class MemoryPalace
{
    protected static function service()
    {
        return Scriptorium::make('memorypalace');
    }

    public static function inscribe(string $key, $value, int $ttl = 0): void
    {
        self::service()::inscribe($key, $value, $ttl);
    }

    public static function recall(string $key, $default = null)
    {
        return self::service()::recall($key, $default);
    }

    public static function forget(string $key): void
    {
        self::service()::forget($key);
    }

    public static function clear(): void
    {
        self::service()::clear();
    }
}
