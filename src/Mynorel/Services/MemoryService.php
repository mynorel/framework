<?php
namespace Mynorel\Services;

class MemoryService
{
    protected static array $store = [];

    public static function remember(string $key, $value): void
    {
        self::$store[$key] = $value;
    }

    public static function get(string $key, $default = null)
    {
        return self::$store[$key] ?? $default;
    }

    public static function forget(string $key): void
    {
        unset(self::$store[$key]);
    }
}
