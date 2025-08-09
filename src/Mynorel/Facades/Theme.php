<?php
namespace Mynorel\Facades;

use Mynorel\Scriptorium\Scriptorium;

/**
 * Theme: Facade for visual and structural theming.
 */
class Theme
{
    protected static function service()
    {
        return Scriptorium::make('theme');
    }

    public static function palette(): array
    {
        return self::service()::palette();
    }

    public static function get(string $key)
    {
        return self::service()::get($key);
    }

    public static function registerDirectives(array $map): void
    {
        self::service()::registerDirectives($map);
    }
}
