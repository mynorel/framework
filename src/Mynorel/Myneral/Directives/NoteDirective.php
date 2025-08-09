<?php
namespace Mynorel\Myneral\Directives;

class NoteDirective extends BaseDirective
{
    public function compile($args, array $context = []): string
    {
        return "<div class='note'>{$args}</div>";
    }
}
