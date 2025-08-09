<?php
namespace Mynorel\Myneral\Directives;

class LayoutDirective extends BaseDirective
{
    public function compile($args, array $context = []): string
    {
        return "<?php // Layout: {$args} ?>";
    }
}
