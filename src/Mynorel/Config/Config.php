<?php
namespace Mynorel\Config;

/**
 * Mynorel Config: Narrative configuration loader and manager.
 *
 * Usage:
 *   Config::get('app.name');
 *   Config::set('my.custom', 'value');
 *   Config::all();
 */

class Config
{
    protected static array $items = [];
    protected static bool $loaded = false;
    protected static bool $loading = false;

    /**
     * Load all config files from /config directory.
     */
    public static function load(?string $configDir = null): void
    {
        if (self::$loaded) return;
        self::$loading = true;
        $configDir = $configDir ?: dirname(__DIR__, 3) . '/config';
        foreach (glob($configDir . '/*.php') as $file) {
            $key = basename($file, '.php');
            self::$items[$key] = require $file;
        }
        self::$loading = false;
        self::$loaded = true;
    }

    /**
     * Get a config value using dot notation (e.g., 'app.name').
     */
    public static function get(string $key, $default = null)
    {
        // Prevent recursion: if called during config load, return only environment/defaults
        if (self::$loading) {
            // Only allow getenv fallback or static default
            return $default;
        }
        self::load();
        $segments = explode('.', $key);
        $value = self::$items;
        foreach ($segments as $segment) {
            if (is_array($value) && array_key_exists($segment, $value)) {
                $value = $value[$segment];
            } else {
                return $default;
            }
        }
        return $value;
    }

    /**
     * Set a config value using dot notation.
     */
    public static function set(string $key, $value): void
    {
        self::load();
        $segments = explode('.', $key);
        $ref = &self::$items;
        foreach ($segments as $segment) {
            if (!isset($ref[$segment]) || !is_array($ref[$segment])) {
                $ref[$segment] = [];
            }
            $ref = &$ref[$segment];
        }
        $ref = $value;
    }

    /**
     * Get all config as an array.
     */
    public static function all(): array
    {
        self::load();
        return self::$items;
    }
}
