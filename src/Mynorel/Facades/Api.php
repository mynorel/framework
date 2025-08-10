<?php
namespace Mynorel\Facades;

use Mynorel\Api\ApiService;

/**
 * Facade for Mynorel API feature.
 * @see ApiService
 */
class Api
{
    public static function handle($request)
    {
        return ApiService::handle($request);
    }
}
