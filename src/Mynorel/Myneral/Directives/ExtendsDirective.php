<?php
namespace Mynorel\Myneral\Directives;

class ExtendsDirective extends BaseDirective
{
    public function compile($args, array $context = []): string
    {
        // Extends is handled at the compiler level, not output
        return '';
    }
}
