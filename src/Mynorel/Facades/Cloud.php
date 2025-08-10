<?php
namespace Mynorel\Facades;

use Mynorel\Cloud\CloudService;

/**
 * Facade for Mynorel Cloud feature.
 * @see CloudService
 */
class Cloud
{
    public static function deploy($app, $provider)
    {
        return CloudService::deploy($app, $provider);
    }
}
