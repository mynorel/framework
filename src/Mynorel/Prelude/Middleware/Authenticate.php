<?php
namespace Mynorel\Prelude\Middleware;
use Mynorel\Prelude\Contracts\PreludeInterface;
/**
 * Example Prelude: Authenticate
 */
class Authenticate implements PreludeInterface
{
    public function handle($context = null): void
    {
        // Example: set user on context, throw if not authenticated
        // ...
    }
}
