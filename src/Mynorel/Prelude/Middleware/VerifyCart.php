<?php
namespace Mynorel\Prelude\Middleware;
use Mynorel\Prelude\Contracts\PreludeInterface;
/**
 * Example Prelude: VerifyCart
 */
class VerifyCart implements PreludeInterface
{
    public function handle($context = null): void
    {
        // Example: check cart validity
        // ...
    }
}
