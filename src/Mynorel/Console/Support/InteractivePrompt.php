<?php
namespace Mynorel\Console\Support;

/**
 * InteractivePrompt: Narrative CLI prompt and menu support for Mynorel.
 */
class InteractivePrompt
{
    /**
     * Prompt the user for input with a narrative message.
     */
    public static function ask(string $question, string $default = ''): string
    {
        echo $question . ($default ? " [$default]" : '') . ': ';
        $input = trim(fgets(STDIN));
        return $input !== '' ? $input : $default;
    }

    /**
     * Present a menu and return the selected option.
     */
    public static function menu(string $title, array $options): string
    {
        echo $title . "\n";
        foreach ($options as $i => $opt) {
            echo "  [" . ($i+1) . "] $opt\n";
        }
        $choice = (int)self::ask('Choose an option');
        return $options[$choice-1] ?? $options[0];
    }
}
