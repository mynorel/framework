<?php
namespace Mynorel\Myneral\Directives;

class SectionDirective extends BaseDirective
{
    protected ?string $content = null;
    public function setContent(?string $content): void { $this->content = $content; }
    public function compile($args, array $context = []): string
    {
        $name = $args[0] ?? null;
        if ($name) {
            if (!isset($context['sections'])) $context['sections'] = [];
            $context['sections'][$name] = $this->content;
        }
        return '';
    }
}
