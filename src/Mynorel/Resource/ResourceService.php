<?php
namespace Mynorel\Resource;

use Mynorel\Config\Config;

/**
 * ResourceService: Provides CRUD UI and logic for resources/entities.
 * Integrates with Author for permissions and Chronicle for logging.
 */
class ResourceService
{
    /**
     * List all registered resources/entities.
     */
    public static function list(): array
    {
        // Only allow authenticated users to list resources
        if (!\Mynorel\Author\AuthService::user()) {
            self::log("Unauthorized resource list attempt");
            throw new \Exception('Unauthorized');
        }
        $resources = Config::get('resources', []);
        // Could add dynamic discovery here
        return $resources;
    }

    /**
     * Register a new resource.
     */
    public static function register($resource)
    {
        // Only allow admin users to register resources
        if (!\Mynorel\Author\AuthService::hasRole('admin')) {
            self::log("Unauthorized resource registration attempt", ['resource' => $resource]);
            throw new \Exception('Unauthorized');
        }
        // Example: Add to registry (stub)
        self::log("Resource registered: $resource");
    }

    /**
     * Check if the current user can manage a resource.
     */
    public static function canManage($resource): bool
    {
    // Only allow admin users to manage resources
    return \Mynorel\Author\AuthService::hasRole('admin');
    }

    /**
     * Log a resource event to Chronicle.
     */
    public static function log($event, $context = [])
    {
        if (class_exists('Mynorel\\Chronicle\\Chronicle')) {
            $msg = '[Resource] ' . $event;
            if (!empty($context)) {
                $msg .= ' | ' . json_encode($context);
            }
            \Mynorel\Chronicle\Chronicle::note($msg);
        }
    }
}
