<?php
namespace Mynorel\Services;

class SystemService
{
    public static function uptime(): string
    {
        return (string) (time() - ($_SERVER['REQUEST_TIME'] ?? time()));
    }

    public static function memoryUsage(): string
    {
        return (string) memory_get_usage(true);
    }

    public static function environment(): string
    {
        return getenv('APP_ENV') ?: 'production';
    }
}
