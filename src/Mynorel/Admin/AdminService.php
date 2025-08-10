<?php
namespace Mynorel\Admin;

use Mynorel\Config\Config;

/**
 * AdminService: Provides dashboard, CRUD, and navigation logic for Mynorel Admin.
 * Integrates with Author for permissions and Chronicle for logging.
 */
class AdminService
{
    /**
     * List all registered resources for CRUD management.
     */
    public static function resources(): array
    {
        // Discover resources from config and ResourceService
        $configResources = Config::get('admin.resources', []);
        $dynamicResources = \Mynorel\Resource\ResourceService::list();
        return array_unique(array_merge($configResources, $dynamicResources));
    }

    /**
     * Check if the current user can access the admin dashboard.
     */
    public static function canAccess(): bool
    {
        return \Mynorel\Author\AuthService::hasRole('admin');
    }

    /**
     * Log an admin event to Chronicle.
     */
    public static function log($event, $context = [])
    {
        if (class_exists('Mynorel\\Chronicle\\Chronicle')) {
            $msg = '[Admin] ' . $event;
            if (!empty($context)) {
                $msg .= ' | ' . json_encode($context);
            }
            \Mynorel\Chronicle\Chronicle::note($msg);
        }
    }

    /**
     * Register a new resource for admin management.
     */
    public static function registerResource($resource)
    {
        // Only allow admin users to register resources
        if (!\Mynorel\Author\AuthService::hasRole('admin')) {
            self::log("Unauthorized resource registration attempt", ['resource' => $resource]);
            throw new \Exception('Unauthorized');
        }
        // This could update config or a registry
        self::log("Resource registered: $resource");
    }

    /**
     * Get navigation structure for admin UI.
     */
    public static function navigation(): array
    {
        return Config::get('admin.navigation', []);
    }

    /**
     * Get widgets for admin dashboard.
     */
    public static function widgets(): array
    {
        return Config::get('admin.widgets', []);
    }
}
