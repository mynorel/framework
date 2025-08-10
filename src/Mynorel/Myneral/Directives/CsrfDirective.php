<?php
namespace Mynorel\Myneral\Directives;

use Mynorel\Myneral\Directives\BaseDirective;
use Mynorel\Http\Csrf;

class CsrfDirective extends BaseDirective
{
    public function compile($args, array $context = []): string
    {
        return Csrf::field();
    }
}
