<?php
namespace Mynorel\Facades;

use Mynorel\Media\MediaService;

/**
 * Facade for Mynorel Media feature.
 * @see MediaService
 */
class Media
{
    public static function upload($file)
    {
        return MediaService::upload($file);
    }
    public static function list()
    {
        return MediaService::list();
    }
}
