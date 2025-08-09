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
        echo "Welcome to the Narrative Console!\n";
        while (true) {
            $input = readline("scene> ");
            if (trim($input) === 'exit') break;
            if (trim($input) === 'replay') {
                Rewind::replay(function($scene, $data, $time) {
                    echo "[Replaying] $scene at $time: ";
                    var_export($data);
                    echo "\n";
                });
                continue;
            }
            PlotTwist::trigger($input);
            Rewind::record($input, []);
            echo "[Scene '$input' played]" . PHP_EOL;
        }
        echo "Goodbye!\n";
    }
}

// Allow direct CLI execution
if (php_sapi_name() === 'cli' && basename(__FILE__) === basename($_SERVER['SCRIPT_FILENAME'])) {
    \Mynorel\Console\NarrativeConsole::start();
}
