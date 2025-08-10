<?php
namespace Mynorel\Console\Commands;

use Mynorel\Console\Output\StylizedPrinter;

class PlaygroundCommand implements \Mynorel\Console\Contracts\CommandInterface
{
    public function name(): string { return 'playground'; }
    public function description(): string { return 'Open an interactive Mynorel playground shell.'; }
    public function execute(array $input, array $output): int
    {
        StylizedPrinter::poetic("Welcome to the Mynorel Playground! Type PHP code to experiment with the framework. Type 'exit' to leave.");
        while (true) {
            $line = readline('mynorel> ');
            if (trim($line) === 'exit') {
                StylizedPrinter::poetic("Leaving the playground. Your story continues.");
                break;
            }
            try {
                eval('$result = ' . $line . ';');
                if (isset($result)) {
                    StylizedPrinter::info("Result: " . var_export($result, true));
                }
            } catch (\Throwable $e) {
                StylizedPrinter::warn("Error: " . $e->getMessage());
            }
        }
        return 0;
    }
}
