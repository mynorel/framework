<?php
namespace Mynorel\Console\Commands;

use Mynorel\Console\Contracts\CommandInterface;
use Mynorel\Console\Output\StylizedPrinter;
use Mynorel\Console\Console;

/**
 * HelpCommand: Shows help for all CLI commands.
 */
class HelpCommand implements CommandInterface
{
    public function execute(array $input, array &$output): int
    {
        $console = $input['console'] ?? null;
        if (!$console instanceof Console) {
            StylizedPrinter::error('Console context not provided.');
            return 1;
        }
        $commands = $console->list();
        StylizedPrinter::info('Mynorel CLI Help:');
        foreach ($commands as $cmd) {
            StylizedPrinter::print('  ' . $cmd['name'] . ' — ' . $cmd['description'], 'module');
        }
        StylizedPrinter::print('');
        StylizedPrinter::print('Run `php mynorel <command>` to execute a command.', 'philosophy');
        return 0;
    }

    public function name(): string
    {
        return 'help';
    }

    public function description(): string
    {
        return 'Show help for all CLI commands.';
    }
}
