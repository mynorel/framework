<?php
namespace Mynorel\Myneral\Directives;

use Mynorel\Author\Auth;
use Mynorel\Myneral\Directives\BaseDirective;

class AuthDirective extends BaseDirective
{
    public function compile($args, array $context = []): string
    {
        return Auth::check() ? 'true' : '';
    }
}
