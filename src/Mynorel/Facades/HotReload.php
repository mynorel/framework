<?php
namespace Mynorel\Facades;

use Mynorel\Myneral\HotReload\HotReloadService;

/**
 * HotReload: Facade for template hot reloading.
 */
class HotReload
{
    public static function watch($path)
    {
        return HotReloadService::watch($path);
    }
}
