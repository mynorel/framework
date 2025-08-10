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

    public static function version(): string
    {
        // Try to get the latest Git tag for versioning
        $version = @trim(shell_exec('git describe --tags --abbrev=0 2>/dev/null'));
        return $version !== '' ? $version : 'dev';
    }
}
