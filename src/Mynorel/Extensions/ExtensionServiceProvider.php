<?php
namespace Mynorel\Extensions;

/**
 * ExtensionServiceProvider: Handles auto-discovery and lifecycle hooks for extensions.
 */
class ExtensionServiceProvider
{
    /**
     * Register and boot all extensions from config/extensions.php
     */
    public static function registerAndBootFromConfig(): void
    {
        // Use the Config Facade for extension config
        $extensions = \Mynorel\Facades\Config::get('extensions', []);
        foreach ($extensions as $class) {
            ExtensionManager::register($class);
        }
        ExtensionManager::bootAll();
    }

    /**
     * Call a lifecycle hook on all extensions if present.
     * @param string $hook
     * @param array $args
     */
    public static function callHook(string $hook, array $args = []): void
    {
        foreach (ExtensionManager::all() as $class) {
            if (method_exists($class, $hook)) {
                $class::$hook(...$args);
            }
        }
    }
}
