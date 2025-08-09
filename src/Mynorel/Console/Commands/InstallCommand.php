<?php
namespace Mynorel\Console\Commands;

use Mynorel\Console\Contracts\CommandInterface;
use Mynorel\Console\Output\StylizedPrinter;

/**
 * InstallCommand: Installs Mynorel core and modules.
 */
class InstallCommand implements CommandInterface
{
    public function execute(array $input, array &$output): int
    {
        StylizedPrinter::poetic('Mynorel has taken root.');
        StylizedPrinter::info('Core, CLI, and Myneral templating are now alive.');
        StylizedPrinter::info('Theme: myneral-dark');
        StylizedPrinter::info('Begin your journey: myne guide');
        return 0;
    }

    public function name(): string
    {
        return 'install';
    }

    public function description(): string
    {
        return 'Install Mynorel core and modules.';
    }
}
