<?php
namespace Mynorel\Myneral\Directives;

class ShowDirective extends BaseDirective
{
    public function compile($args, array $context = []): string
    {
    $text = is_array($args) ? implode(' ', $args) : (string)$args;
    return "<div class='show'>{$text}</div>";
    }
}
