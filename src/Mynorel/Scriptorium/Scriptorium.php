<?php
namespace Mynorel\Scriptorium;

/**
 * Scriptorium: Mynorel's narrative service container.
 * Casts, stores, and retrieves story elements (services, characters, props).
 */
class Scriptorium
{
    protected static array $bindings = [];
    protected static array $singletons = [];
    protected static array $instances = [];

    /**
     * Bind a service (transient).
     */
    public static function bind(string $name, callable $resolver): void
    {
        self::$bindings[$name] = $resolver;
    }

    /**
     * Bind a singleton (shared instance).
     */
    public static function singleton(string $name, callable $resolver): void
    {
        self::$singletons[$name] = $resolver;
    }

    /**
     * Resolve a service or singleton.
     */
    public static function make(string $name, ...$args)
    {
        if (isset(self::$instances[$name])) {
            return self::$instances[$name];
        }
        if (isset(self::$singletons[$name])) {
            return self::$instances[$name] = self::$singletons[$name](...$args);
        }
        if (isset(self::$bindings[$name])) {
            return self::$bindings[$name](...$args);
        }
        throw new \RuntimeException("Scriptorium: '$name' not found.");
    }

    /**
     * Check if a binding exists.
     */
    public static function has(string $name): bool
    {
        return isset(self::$bindings[$name]) || isset(self::$singletons[$name]);
    }

    /**
     * Clear all bindings and instances (for testing).
     */
    public static function clear(): void
    {
        self::$bindings = self::$singletons = self::$instances = [];
    }
}
