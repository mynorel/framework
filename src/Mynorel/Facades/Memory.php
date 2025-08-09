<?php
namespace Mynorel\Facades;

use Mynorel\Services\MemoryService;

/**
 * Memory: Facade for state and persistence.
 */
class Memory
{
    public static function remember(string $key, $value): void
    {
        MemoryService::remember($key, $value);
    }

    public static function get(string $key, $default = null)
    {
        return MemoryService::get($key, $default);
    }

    public static function forget(string $key): void
    {
        MemoryService::forget($key);
    }
}
