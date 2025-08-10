<?php
namespace Mynorel\Plugin;

use Mynorel\Config\Config;

/**
 * PluginService: Manages plugin/theme discovery and activation.
 * Integrates with Chronicle for logging.
 */
class PluginService
{
    /**
     * List all available plugins.
     */
    public static function list(): array
    {
        // Discover plugins from config and directory
        $configPlugins = Config::get('plugins', []);
        $pluginDir = Config::get('plugin.dir', __DIR__ . '/../../../plugins');
        $dirPlugins = is_dir($pluginDir) ? array_diff(scandir($pluginDir), ['.', '..']) : [];
        return array_unique(array_merge($configPlugins, $dirPlugins));
    }

    /**
     * Activate a plugin.
     */
    public static function activate($plugin): bool
    {
        // Only allow admin users to activate plugins
        if (!\Mynorel\Author\AuthService::hasRole('admin')) {
            self::log("Unauthorized plugin activation attempt", ['plugin' => $plugin]);
            throw new \Exception('Unauthorized');
        }
        self::log("Plugin activated: $plugin");
        return true;
    }

    /**
     * Deactivate a plugin.
     */
    public static function deactivate($plugin): bool
    {
        // Only allow admin users to deactivate plugins
        if (!\Mynorel\Author\AuthService::hasRole('admin')) {
            self::log("Unauthorized plugin deactivation attempt", ['plugin' => $plugin]);
            throw new \Exception('Unauthorized');
        }
        self::log("Plugin deactivated: $plugin");
        return true;
    }

    /**
     * Log a plugin event to Chronicle.
     */
    public static function log($event, $context = [])
    {
        if (class_exists('Mynorel\\Chronicle\\Chronicle')) {
            $msg = '[Plugin] ' . $event;
            if (!empty($context)) {
                $msg .= ' | ' . json_encode($context);
            }
            \Mynorel\Chronicle\Chronicle::note($msg);
        }
    }
}
