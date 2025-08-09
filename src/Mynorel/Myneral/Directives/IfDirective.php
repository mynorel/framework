<?php
namespace Mynorel\Myneral\Directives;

class IfDirective extends BaseDirective
{
    public function compile($args, array $context = []): string
    {
        return "<?php if ({$args}): ?>";
    }
}
