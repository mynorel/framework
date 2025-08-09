<?php
namespace Mynorel\Myneral\Directives;

class ShowDirective extends BaseDirective
{
    public function compile($args, array $context = []): string
    {
        return "<div class='show'>{$args}</div>";
    }
}
