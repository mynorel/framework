<?php
namespace Mynorel\Extensions;

/**
 * ExtensionManager: Handles registration and loading of Mynorel extensions (side stories).
 */
class ExtensionManager
{
    protected static array $extensions = [];

    /**
     * Register an extension (side story).
     * @param string $class
     * @return void
     */
    public static function register(string $class): void
    {
        if (!in_array($class, self::$extensions, true)) {
            self::$extensions[] = $class;
        }
    }

    /**
     * Get all registered extensions.
     * @return array
     */
    public static function all(): array
    {
        return self::$extensions;
    }

    /**
     * Load all registered extensions (call their boot method if present).
     * @return void
     */
    public static function bootAll(): void
    {
        foreach (self::$extensions as $class) {
            if (class_exists($class) && method_exists($class, 'boot')) {
                $class::boot();
            }
        }
    }
}
