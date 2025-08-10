<?php
namespace Mynorel\Facades;

use Mynorel\Search\SearchService;

/**
 * Facade for Mynorel Search feature.
 * @see SearchService
 */
class Search
{
    public static function search($query)
    {
        return SearchService::search($query);
    }
}
