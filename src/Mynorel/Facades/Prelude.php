<?php
namespace Mynorel\Facades;

use Mynorel\Prelude\Prelude as PreludeCore;

/**
 * Prelude: Facade for middleware/prelude integration.
 */
class Prelude
{
    /**
     * Run prelude/middleware for a directive (called by Myneral).
     *
     * @param string $directive
     * @param array $context
     * @return void
     */
    public static function runForDirective(string $directive, array $context = []): void
    {
        // Example: Map directive to prelude(s) and run them
        $map = [
            'checkout' => [
                \Mynorel\Prelude\Middleware\Authenticate::class,
                \Mynorel\Prelude\Middleware\VerifyCart::class,
            ],
            // Add more directive-prelude mappings as needed
        ];
        if (isset($map[$directive])) {
            PreludeCore::run($map[$directive], $context);
        }
    }

    /**
     * Run prelude(s) by name or class directly (for general use).
     *
     * @param string|array $preludes
     * @param mixed $context
     * @return void
     */
    public static function run($preludes, $context = null): void
    {
        PreludeCore::run($preludes, $context);
    }
}
