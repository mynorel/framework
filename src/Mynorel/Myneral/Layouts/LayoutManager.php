<?php
namespace Mynorel\Myneral\Layouts;

class LayoutManager
{
    protected static array $layouts = [];

    public static function register(string $name, Layout $layout): void
    {
        self::$layouts[$name] = $layout;
    }

    public static function get(string $name): ?Layout
    {
        return self::$layouts[$name] ?? null;
    }
}
