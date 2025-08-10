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
        // Use Mynorel Config layer for environment
        if (class_exists('Mynorel\\Config\\Config')) {
            return \Mynorel\Config\Config::get('app.env', 'production');
        }
        return getenv('APP_ENV') ?: 'production';
    }
}
