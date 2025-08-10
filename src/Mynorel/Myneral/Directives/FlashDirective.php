<?php
namespace Mynorel\Myneral\Directives;

use Mynorel\Session\Flash;
use Mynorel\Myneral\Directives\BaseDirective;

class FlashDirective extends BaseDirective
{
    public function compile($args, array $context = []): string
    {
        $key = $args[0] ?? null;
        return $key ? Flash::get($key) : '';
    }
}
