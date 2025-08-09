<?php
namespace Mynorel\ThemeSkins;

/**
 * ThemeSkins: Pluggable theming system for Mynorel CLI/web output.
 * Skins are narrative themes for your app’s presentation.
 */
class ThemeSkins
{
    protected static array $skins = [];
    protected static ?string $active = null;


    /**
     * Register a new skin.
     */
    public static function register(string $name, callable $formatter): void
    {
        self::$skins[$name] = $formatter;
    }

    /**
     * List all registered skins.
     */
    public static function list(): array
    {
        return array_keys(self::$skins);
    }

    /**
     * Get the active skin name.
     */
    public static function active(): ?string
    {
        return self::$active;
    }

    /**
     * Set the active skin.
     */
    public static function activate(string $name): void
    {
        if (isset(self::$skins[$name])) {
            self::$active = $name;
        }
    }

    /**
     * Format output using the active skin.
     */
    public static function format(string $text): string
    {
        if (self::$active && isset(self::$skins[self::$active])) {
            return self::$skins[self::$active]($text);
        }
        return $text;
    }
}
