<?php
namespace Mynorel\Facades;

use Mynorel\Resource\ResourceService;

/**
 * Facade for Mynorel Resource feature.
 * @see ResourceService
 */
class Resource
{
    public static function list()
    {
        return ResourceService::list();
    }
    public static function register($name)
    {
        return ResourceService::register($name);
    }
}
