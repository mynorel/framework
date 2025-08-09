<?php
namespace Mynorel\Myneral\Directives;

class FlowDirective extends BaseDirective
{
    public function compile($args, array $context = []): string
    {
        return "<?php // Flow: {$args} ?>";
    }
}
