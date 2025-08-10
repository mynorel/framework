<?php
namespace Mynorel\Facades;

use Mynorel\Plugin\Marketplace\MarketplaceService;

/**
 * Marketplace: Facade for plugin discovery and installation.
 */
class Marketplace
{
    public static function list()
    {
        return MarketplaceService::listPlugins();
    }

    public static function install(string $name)
    {
        return MarketplaceService::install($name);
    }
}
