<?php
namespace Mynorel\Myneral\Directives;

class YieldDirective extends BaseDirective
{
    public function compile($args, array $context = []): string
    {
        $name = $args[0] ?? null;
        return $name && isset($context['sections'][$name]) ? $context['sections'][$name] : '';
    }
}
