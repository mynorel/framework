<?php
namespace Mynorel\Cloud;

use Mynorel\Config\Config;

/**
 * CloudService: Integrates with cloud providers for deployment and scaling.
 * Integrates with Chronicle for logging.
 */
class CloudService
{
    /**
     * Deploy an app to a cloud provider.
     */
    public static function deploy($app, $provider): bool
    {
        // Only allow admin users to deploy
        if (!\Mynorel\Author\AuthService::hasRole('admin')) {
            self::log("Unauthorized deploy attempt", ['app' => $app, 'provider' => $provider]);
            throw new \Exception('Unauthorized');
        }
        // Validate input
        if (empty($app) || empty($provider)) {
            self::log("Deploy failed: missing app or provider");
            return false;
        }
        self::log("App $app deployed to $provider");
        return true;
    }

    /**
     * Scale an app on a cloud provider.
     */
    public static function scale($app, $provider, $instances): bool
    {
        // Only allow admin users to scale
        if (!\Mynorel\Author\AuthService::hasRole('admin')) {
            self::log("Unauthorized scale attempt", ['app' => $app, 'provider' => $provider]);
            throw new \Exception('Unauthorized');
        }
        if (empty($app) || empty($provider) || !is_numeric($instances) || $instances < 1) {
            self::log("Scale failed: invalid input");
            return false;
        }
        self::log("App $app scaled to $instances on $provider");
        return true;
    }

    /**
     * Log a cloud event to Chronicle.
     */
    public static function log($event, $context = [])
    {
        if (class_exists('Mynorel\\Chronicle\\Chronicle')) {
            $msg = '[Cloud] ' . $event;
            if (!empty($context)) {
                $msg .= ' | ' . json_encode($context);
            }
            \Mynorel\Chronicle\Chronicle::note($msg);
        }
    }
}
