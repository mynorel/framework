<?php
namespace Mynorel\Myneral\Directives;

class NoteDirective extends BaseDirective
{
    public function compile($args, array $context = []): string
    {
        // If used as a block, output the content; otherwise, use args
        if ($this->content !== null) {
            return "<div class='note'>" . $this->content . "</div>";
        }
    $text = isset($args[0]) ? $args[0] : '';
    return "<div class='note'>" . $text . "</div>";
    }
}
