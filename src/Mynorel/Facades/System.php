<?php
namespace Mynorel\Facades;

use Mynorel\Services\SystemService;

/**
 * System: Facade for core runtime and environment info.
 */
class System
{
    public static function uptime(): string
    {
        return SystemService::uptime();
    }

    public static function memoryUsage(): string
    {
        return SystemService::memoryUsage();
    }

    public static function environment(): string
    {
        return SystemService::environment();
    }
}
