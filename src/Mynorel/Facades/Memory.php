<?php
namespace Mynorel\Facades;

use Mynorel\Scriptorium\Scriptorium;

/**
 * Memory: Facade for state and persistence.
 */
class Memory
{
    protected static function service()
    {
        return Scriptorium::make('memory');
    }

    public static function remember(string $key, $value): void
    {
        self::service()::remember($key, $value);
    }

    public static function get(string $key, $default = null)
    {
        return self::service()::get($key, $default);
    }

    public static function forget(string $key): void
    {
        self::service()::forget($key);
    }
}
