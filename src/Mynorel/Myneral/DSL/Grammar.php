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
    // DEBUG: Uncomment to print tokens and block stack
    // register_shutdown_function(function() use (&$tokens, &$blockStack) {
    //     file_put_contents('/tmp/myneral_grammar_debug.log', print_r(['tokens'=>$tokens,'blockStack'=>$blockStack], true));
    // });
    {
        $tokens = [];
        $offset = 0;
        $len = strlen($template);
        $blockStack = [];
        $errors = [];

    // Regex for @directive('arg') and block start/end, robust to leading whitespace and newlines
    $pattern = '/^[ \t]*@(end\w+|\w+)(\(([^)]*)\))?/m';
    $pendingBlocks = [];
    $blockOpen = [];
    while (preg_match($pattern, $template, $match, PREG_OFFSET_CAPTURE, $offset)) {
        $full = $match[0][0];
        $pos = $match[0][1];
        $before = substr($template, $offset, $pos - $offset);
        if ($before !== '') {
            $tokens[] = ['type' => 'text', 'content' => $before];
        }
        $raw = $match[1][0];
        $argsRaw = isset($match[3][0]) ? $match[3][0] : '';
        if (str_starts_with($raw, 'end')) {
            $endName = strtolower(substr($raw, 3));
            if (!empty($blockOpen) && strtolower(end($blockOpen)) === $endName) {
                array_pop($blockOpen);
                $tokens[] = ['type' => 'block_end', 'directive' => $endName];
            } else {
                $errors[] = "Unexpected @$raw at position $pos";
            }
        } else {
            $name = $raw;
            $args = [];
            if ($argsRaw !== '') {
                preg_match_all('/(["\']).*?\1|([^,\s]+)/', $argsRaw, $matches);
                foreach ($matches[0] as $arg) {
                    $arg = trim($arg);
                    if ($arg === '') continue;
                    if ((str_starts_with($arg, '"') && str_ends_with($arg, '"')) || (str_starts_with($arg, "'") && str_ends_with($arg, "'"))) {
                        $arg = substr($arg, 1, -1);
                    }
                    $args[] = $arg;
                }
            }
            if (self::isBlockDirective($name)) {
                // Look ahead for matching @end{name} at the same nesting level
                $after = substr($template, $pos + strlen($full));
                if (preg_match('/^[ \t\r\n]*@end' . preg_quote($name, '/') . '\b/mi', $after)) {
                    $blockOpen[] = $name;
                    $tokens[] = ['type' => 'block_start', 'directive' => $name, 'args' => $args];
                } else {
                    $tokens[] = ['type' => 'directive', 'directive' => $name, 'args' => $args];
                }
            } else {
                $tokens[] = ['type' => 'directive', 'directive' => $name, 'args' => $args];
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
            // TEMP: Print errors and blockStack for debug
            echo "\n[DEBUG] blockStack: ", print_r($blockStack, true), "\n";
            echo "[DEBUG] errors: ", print_r($errors, true), "\n";
            $tokens[] = ['type' => 'error', 'errors' => $errors];
        }
        return $tokens;
    }

    /**
     * Determine if a directive is a block directive (requires end...)
     */
    protected static function isBlockDirective(string $name): bool
    {
    // Only true block directives require an end
    return in_array($name, ['can', 'role', 'if', 'flow', 'layout']);
    }
}
