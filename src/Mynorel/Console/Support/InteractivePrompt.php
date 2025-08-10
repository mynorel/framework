<?php
namespace Mynorel\Console\Support;

/**
 * InteractivePrompt: Narrative CLI prompt and menu support for Mynorel.
 */
class InteractivePrompt
{
    /**
     * Prompt the user for input with a narrative message.
     * Supports auto-completion and fuzzy suggestions if options are provided.
     */
    public static function ask(string $question, string $default = '', array $options = []): string
    {
        echo $question . ($default ? " [$default]" : '') . ': ';
        $input = trim(fgets(STDIN));
        if ($input === '' && $default !== '') return $default;
        if ($options && $input !== '') {
            // Fuzzy match and suggest completions
            $matches = \Mynorel\Console\Support\AutoComplete::fuzzy($input, $options);
            if ($matches && strtolower($matches[0]) !== strtolower($input)) {
                echo "\nDid you mean: " . implode(', ', array_slice($matches, 0, 3)) . "?\n";
                return $matches[0];
            }
        }
        return $input;
    }

    /**
     * Present a menu and return the selected option.
     * Supports auto-completion and fuzzy search.
     */
    public static function menu(string $title, array $options): string
    {
        echo $title . "\n";
        foreach ($options as $i => $opt) {
            echo "  [" . ($i+1) . "] $opt\n";
        }
        $choice = self::ask('Choose an option', '', $options);
        // Allow numeric or fuzzy string selection
        if (is_numeric($choice) && isset($options[(int)$choice-1])) {
            return $options[(int)$choice-1];
        }
        // Fuzzy match fallback
        $matches = \Mynorel\Console\Support\AutoComplete::fuzzy($choice, $options);
        return $matches[0] ?? $options[0];
    }
}
