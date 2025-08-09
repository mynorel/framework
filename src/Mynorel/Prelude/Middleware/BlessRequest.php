<?php
namespace Mynorel\Prelude\Middleware;
use Mynorel\Prelude\Contracts\PreludeInterface;
/**
 * Example Prelude: BlessRequest
 */
class BlessRequest implements PreludeInterface
{
    public function handle($context = null): void
    {
        // Example: add blessing to request context
        // ...
    }
}
