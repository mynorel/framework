<?php
namespace Mynorel\Console\Commands;

use Mynorel\Console\Contracts\CommandInterface;
use Mynorel\Console\Output\StylizedPrinter;
use Mynorel\Console\Console;

/**
 * ListCommand: Lists all available CLI commands.
 */
class ListCommand implements CommandInterface
{
    public function execute(array $input, array &$output): int
    {
        // Assume $input['console'] is the Console instance
        $console = $input['console'] ?? null;
        if (!$console instanceof Console) {
            StylizedPrinter::error('Console context not provided.');
            return 1;
        }
        $commands = $console->list();
        StylizedPrinter::info('Available Commands:');
        foreach ($commands as $cmd) {
            StylizedPrinter::print('  ' . $cmd['name'] . ' — ' . $cmd['description'], 'module');
        }
        return 0;
    }

    public function name(): string
    {
        return 'list';
    }

    public function description(): string
    {
        return 'List all available CLI commands.';
    }
}
