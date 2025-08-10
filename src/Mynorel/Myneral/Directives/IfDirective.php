<?php
namespace Mynorel\Myneral\Directives;

class IfDirective extends BaseDirective
{
    public function compile($args, array $context = []): string
    {
        $cond = isset($args[0]) ? $args[0] : '';
        $content = $this->content !== null ? $this->content : '';
        return "<?php if ($cond): ?>$content<?php endif; ?>";
    }
}
