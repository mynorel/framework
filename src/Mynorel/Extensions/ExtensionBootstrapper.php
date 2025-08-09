<?php
namespace Mynorel\Extensions;

/**
 * ExtensionBootstrapper: Integrates extension booting into Mynorel's core lifecycle.
 */
class ExtensionBootstrapper
{
    public static function bootAllExtensions(): void
    {
        ExtensionManager::bootAll();
    }
}
