<?php
namespace Mynorel\Api;

use Mynorel\Config\Config;

/**
 * ApiService: Scaffolds RESTful endpoints for resources.
 * Integrates with Author for auth and Chronicle for logging.
 */
class ApiService
{
    /**
     * Handle an API request (RESTful routing, auth, serialization).
     */
    public static function handle($request)
    {
        // Example: Simple RESTful router (stub)
        $method = strtoupper($request['method'] ?? 'GET');
        $path = $request['path'] ?? '/';
        $user = \Mynorel\Author\AuthService::user();
        // Only allow authenticated users
        if (!$user) {
            self::log("Unauthorized API access", ['path' => $path]);
            return ['status' => 'error', 'message' => 'Unauthorized'];
        }
        // CSRF protection for state-changing methods
        if (in_array($method, ['POST', 'PUT', 'DELETE'])) {
            if (empty($request['csrf_token']) || $request['csrf_token'] !== ($_SESSION['csrf_token'] ?? null)) {
                self::log("CSRF token mismatch", ['user' => $user['username']]);
                return ['status' => 'error', 'message' => 'CSRF token mismatch'];
            }
        }
        // Route to resource
        if ($path === '/resources' && $method === 'GET') {
            $resources = \Mynorel\Resource\ResourceService::list();
            self::log("API resources listed", ['user' => $user['username']]);
            return ['status' => 'ok', 'data' => $resources];
        }
        self::log("API route not found", ['path' => $path]);
        return ['status' => 'error', 'message' => 'Not found'];
    }

    /**
     * Log an API event to Chronicle.
     */
    public static function log($event, $context = [])
    {
        if (class_exists('Mynorel\\Chronicle\\Chronicle')) {
            $msg = '[API] ' . $event;
            if (!empty($context)) {
                $msg .= ' | ' . json_encode($context);
            }
            \Mynorel\Chronicle\Chronicle::note($msg);
        }
    }
}
