<?php
namespace Mynorel\Console\Commands;

use Mynorel\Console\Contracts\CommandInterface;
use Mynorel\Console\Output\StylizedPrinter;
use Mynorel\Chronicle\Writer;

/**
 * LogCommand: Outputs the narrative log (Chronicle) in poetic style.
 */
class LogCommand implements CommandInterface
{
    public function execute(array $input, array &$output): int
    {
        $entries = Writer::all();
        if (empty($entries)) {
            StylizedPrinter::info('No log entries yet.');
            return 0;
        }
        StylizedPrinter::info('Chronicle log:');
        foreach ($entries as $entry) {
            // Use PoeticFormatter for output
            $line = \Mynorel\Chronicle\Formatters\PoeticFormatter::format($entry);
            StylizedPrinter::print($line);
        }
        return 0;
    }

    public function name(): string
    {
        return 'log';
    }

    public function description(): string
    {
        return 'Show the narrative log (Chronicle) in poetic style.';
    }
}
