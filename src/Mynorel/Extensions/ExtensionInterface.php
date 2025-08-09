<?php
namespace Mynorel\Extensions;

/**
 * ExtensionInterface: Contract for Mynorel extensions (side stories).
 */
interface ExtensionInterface
{
    /**
     * Boot the extension (register hooks, services, etc).
     * @return void
     */
    public static function boot(): void;
}
