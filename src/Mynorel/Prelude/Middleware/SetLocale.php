<?php
namespace Mynorel\Prelude\Middleware;
use Mynorel\Prelude\Contracts\PreludeInterface;
/**
 * Example Prelude: SetLocale
 */
class SetLocale implements PreludeInterface
{
    public function handle($context = null): void
    {
        // Example: set locale on context
        // ...
    }
}
