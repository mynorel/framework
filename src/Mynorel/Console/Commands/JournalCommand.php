<?php
namespace Mynorel\Console\Commands;

use Mynorel\Console\Contracts\CommandInterface;
use Mynorel\Console\Output\StylizedPrinter;
use Mynorel\Chronicle\Writer;

/**
 * JournalCommand: Outputs a developer journal from the Chronicle log.
 */
class JournalCommand implements CommandInterface
{
    public function execute(array $input, array &$output): int
    {
        $entries = Writer::all();
        if (empty($entries)) {
            StylizedPrinter::info('No journal entries yet.');
            return 0;
        }
        StylizedPrinter::info('Developer Journal:');
        foreach ($entries as $entry) {
            $date = date('M d', $entry->timestamp);
            $line = "→ $date: $entry->message";
            StylizedPrinter::print($line);
        }
        return 0;
    }

    public function name(): string
    {
        return 'journal';
    }

    public function description(): string
    {
        return 'Show the developer journal from the Chronicle log.';
    }
}
