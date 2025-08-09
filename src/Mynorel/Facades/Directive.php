<?php
namespace Mynorel\Facades;

use Mynorel\Services\DirectiveCompiler;

/**
 * Directive: Facade for syntax and templating engine.
 */
class Directive
{
    public static function compile(string $name, callable $handler): void
    {
        DirectiveCompiler::compile($name, $handler);
    }

    public static function register(array $directives): void
    {
        DirectiveCompiler::register($directives);
    }
}
