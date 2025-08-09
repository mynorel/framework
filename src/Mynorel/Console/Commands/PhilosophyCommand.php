<?php
namespace Mynorel\Console\Commands;

use Mynorel\Console\Contracts\CommandInterface;
use Mynorel\Console\Output\StylizedPrinter;

/**
 * PhilosophyCommand: Shares Mynorel's philosophy and narrative approach.
 */
class PhilosophyCommand implements CommandInterface
{
    public function execute(array $input, array &$output): int
    {
        StylizedPrinter::poetic('Mynorel is a narrative-first framework.');
        StylizedPrinter::info('Every route is a chapter, every model a character, every log a story interruption.');
        StylizedPrinter::info('Build with story, not just code.');
        return 0;
    }

    public function name(): string
    {
        return 'philosophy';
    }

    public function description(): string
    {
        return 'Share Mynorel\'s philosophy and narrative approach.';
    }
}
