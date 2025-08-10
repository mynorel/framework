<?php
namespace Mynorel\Stylist\PostCSS;

/**
 * PostCSSPluginManager: Register and manage PostCSS plugins for Stylist.
 * Narrative-driven, modular, and extensible.
 */
class PostCSSPluginManager {
    protected static array $plugins = [];

    public static function register(string $name, callable $handler): void {
        self::$plugins[$name] = $handler;
    }

    public static function getPlugins(): array {
        return self::$plugins;
    }

    // ...narrative plugin logic...
}
