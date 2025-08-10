<?php
namespace Mynorel\Myneral\Directives;

class FlowDirective extends BaseDirective
{
    public function compile($args, array $context = []): string
    {
        return $this->content !== null ? $this->content : (isset($args[0]) ? $args[0] : '');
    }
}
