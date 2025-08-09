<?php
namespace Mynorel\Facades;

use Mynorel\Services\ThemeService;

/**
 * Theme: Facade for visual and structural theming.
 */
class Theme
{
    public static function palette(): array
    {
        return ThemeService::palette();
    }

    public static function get(string $key)
    {
        return ThemeService::get($key);
    }

    public static function registerDirectives(array $map): void
    {
        ThemeService::registerDirectives($map);
    }
}
