<?php
namespace Mynorel\Myneral\Directives;

class LayoutDirective extends BaseDirective
{
    public function compile($args, array $context = []): string
    {
        // For now, just return the block content (pass-through)
        return $this->content ?? '';
    }
}
