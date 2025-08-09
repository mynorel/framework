<?php
namespace Mynorel\Myneral\DSL;

/**
 * Grammar: Defines the parsing rules for Myneral's directive language.
 */
class Grammar
{
    /**
     * Parse a Myneral template string into an array of directive tokens.
     * @param string $template
     * @return array
     */
    public static function parse(string $template): array
    {
        $tokens = [];
        $offset = 0;
        $len = strlen($template);
        $blockStack = [];
        $errors = [];

        // Regex for @directive('arg') and block start/end
        $pattern = '/@(\w+)(\(([^)]*)\))?|@(end\w+)/';
        while (preg_match($pattern, $template, $match, PREG_OFFSET_CAPTURE, $offset)) {
            $full = $match[0][0];
            $pos = $match[0][1];
            $before = substr($template, $offset, $pos - $offset);
            if ($before !== '') {
                // Add plain text as a token
                $tokens[] = ['type' => 'text', 'content' => $before];
            }
            if (!empty($match[1][0])) {
                // Block start or inline directive
                $name = $match[1][0];
                $args = isset($match[3][0]) ? trim($match[3][0], "'\" ") : '';
                // Check if this is a block directive (has a matching end)
                if (self::isBlockDirective($name)) {
                    $blockStack[] = ['name' => $name, 'start' => count($tokens)];
                    $tokens[] = ['type' => 'block_start', 'directive' => $name, 'args' => $args];
                } else {
                    $tokens[] = ['type' => 'directive', 'directive' => $name, 'args' => $args];
                }
            } elseif (!empty($match[4][0])) {
                // Block end
                $endName = substr($match[4][0], 3); // e.g., endcan -> can
                if (!empty($blockStack) && end($blockStack)['name'] === $endName) {
                    $block = array_pop($blockStack);
                    $tokens[] = ['type' => 'block_end', 'directive' => $endName];
                } else {
                    $errors[] = "Unexpected @$match[4][0] at position $pos";
                }
            }
            $offset = $pos + strlen($full);
        }
        // Add any trailing text
        if ($offset < $len) {
            $tokens[] = ['type' => 'text', 'content' => substr($template, $offset)];
        }
        // Error for any unclosed blocks
        foreach ($blockStack as $block) {
            $errors[] = "Unclosed block directive @{$block['name']}";
        }
        if (!empty($errors)) {
            $tokens[] = ['type' => 'error', 'errors' => $errors];
        }
        return $tokens;
    }

    /**
     * Determine if a directive is a block directive (requires end...)
     */
    protected static function isBlockDirective(string $name): bool
    {
        // Add more block directives as needed
        return in_array($name, ['can', 'role', 'if', 'flow', 'layout', 'note', 'show']);
    }
}
