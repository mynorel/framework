<?php
namespace Mynorel\Console;

use Mynorel\PlotTwist\PlotTwist;
use Mynorel\Rewind\Rewind;

/**
 * NarrativeConsole: Interactive CLI to play through your app's story.
 */
class NarrativeConsole
{
    public static function start(): void
    {
    echo \Mynorel\ThemeSkins\ThemeSkins::format("Welcome to the Narrative Console!\n");
        while (true) {
            $input = readline("scene> ");
            if (trim($input) === 'exit') break;
            if (trim($input) === 'replay') {
                Rewind::replay(function($scene, $data, $time) {
                    echo \Mynorel\ThemeSkins\ThemeSkins::format("[Replaying] $scene at $time: ");
                    var_export($data);
                    echo \Mynorel\ThemeSkins\ThemeSkins::format("\n");
                });
                continue;
            }
            PlotTwist::trigger($input);
            Rewind::record($input, []);
            echo \Mynorel\ThemeSkins\ThemeSkins::format("[Scene '$input' played]" . PHP_EOL);
        }
    echo \Mynorel\ThemeSkins\ThemeSkins::format("Goodbye!\n");
    }
}

// Allow direct CLI execution
if (php_sapi_name() === 'cli' && basename(__FILE__) === basename($_SERVER['SCRIPT_FILENAME'])) {
    \Mynorel\Console\NarrativeConsole::start();
}
