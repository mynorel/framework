<?php
namespace Mynorel\Facades;

use Mynorel\Manifest\Manifest as ManifestCore;

/**
 * Manifest: Facade for manifest/module/philosophy introspection.
 */
class Manifest
{
    protected static bool $loaded = false;

    protected static function ensureLoaded(): void
    {
        if (!static::$loaded) {
            // Try cwd first, fallback to parent if needed
            $path = file_exists('mynorel.json') ? 'mynorel.json' : dirname(__DIR__, 4) . '/mynorel.json';
            ManifestCore::load($path);
            static::$loaded = true;
        }
    }

    public static function modules(): array
    {
        static::ensureLoaded();
        return ManifestCore::modules();
    }

    public static function philosophy(): array
    {
        static::ensureLoaded();
        return ManifestCore::philosophy();
    }

    public static function describe(): string
    {
        static::ensureLoaded();
        return ManifestCore::describe();
    }
}
