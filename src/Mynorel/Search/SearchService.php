<?php
namespace Mynorel\Search;

use Mynorel\Config\Config;

/**
 * SearchService: Provides full-text and structured search.
 * Integrates with Chronicle for logging.
 */
class SearchService
{
    /**
     * Perform a full-text search across all resources.
     */
    public static function search($query): array
    {
        // Only allow authenticated users to search
        if (!\Mynorel\Author\AuthService::user()) {
            self::log("Unauthorized search attempt");
            throw new \Exception('Unauthorized');
        }
        $results = [];
        $resources = \Mynorel\Resource\ResourceService::list();
        foreach ($resources as $resource) {
            // Example: Search in resource name/fields (stub)
            if (stripos(json_encode($resource), $query) !== false) {
                $results[] = $resource;
            }
        }
        self::log("Search performed", ['query' => $query, 'count' => count($results)]);
        return $results;
    }

    /**
     * Log a search event to Chronicle.
     */
    public static function log($event, $context = [])
    {
        if (class_exists('Mynorel\\Chronicle\\Chronicle')) {
            $msg = '[Search] ' . $event;
            if (!empty($context)) {
                $msg .= ' | ' . json_encode($context);
            }
            \Mynorel\Chronicle\Chronicle::note($msg);
        }
    }
}
