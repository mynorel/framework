<?php
namespace Mynorel\Myneral\Layouts;
use Mynorel\Myneral\Layouts\TestLayout;

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

    public static function registerTestLayouts(): void
    {
        self::register('main', new TestLayout());
    }
}
