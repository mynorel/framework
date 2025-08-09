<?php
namespace Mynorel\Facades;

use Mynorel\Extensions\ExtensionManager;

/**
 * Extension: Facade for registering and booting Mynorel extensions (side stories).
 */
class Extension
{
    public static function register(string $class): void
    {
        ExtensionManager::register($class);
    }

    public static function bootAll(): void
    {
        ExtensionManager::bootAll();
    }
}
