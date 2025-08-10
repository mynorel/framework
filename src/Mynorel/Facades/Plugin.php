<?php
namespace Mynorel\Facades;

use Mynorel\Plugin\PluginService;

/**
 * Facade for Mynorel Plugin feature.
 * @see PluginService
 */
class Plugin
{
    public static function list()
    {
        return PluginService::list();
    }
    public static function activate($name)
    {
        return PluginService::activate($name);
    }
}
