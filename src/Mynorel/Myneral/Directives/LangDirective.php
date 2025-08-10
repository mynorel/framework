<?php
namespace Mynorel\Myneral\Directives;

class LangDirective extends BaseDirective
{
    public function compile($args, array $context = []): string
    {
        $key = $args[0] ?? null;
        $locale = $context['locale'] ?? 'en';
        if (!$key) return '';
        // Example: translations stored in $context['translations'][$locale][$key]
        if (isset($context['translations'][$locale][$key])) {
            return $context['translations'][$locale][$key];
        }
        return $key;
    }
}
