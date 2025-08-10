<?php
namespace Mynorel\Console\Support;

/**
 * AutoComplete: Provides command and argument auto-completion and fuzzy search for Mynorel CLI.
 */
class AutoComplete
{
    /**
     * Fuzzy search for a command or argument from a list.
     * @param string $input
     * @param array $options
     * @return string[] Sorted by best match
     */
    public static function fuzzy(string $input, array $options): array
    {
        $scores = [];
        foreach ($options as $option) {
            similar_text(strtolower($input), strtolower($option), $percent);
            $scores[$option] = $percent;
        }
        arsort($scores);
        return array_keys($scores);
    }

    /**
     * Suggest completions for a partial input.
     * @param string $input
     * @param array $options
     * @return array
     */
    public static function complete(string $input, array $options): array
    {
        $matches = array_filter($options, fn($opt) => stripos($opt, $input) === 0);
        return array_values($matches);
    }
}
