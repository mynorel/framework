<?php
namespace Mynorel\Console\Commands;

use Mynorel\Console\Contracts\CommandInterface;
use Mynorel\Console\Output\StylizedPrinter;
use Mynorel\Myneral\Flows\FlowManager;

/**
 * FlowValidateCommand: Validates a named flow and reports missing directives.
 */
class FlowValidateCommand implements CommandInterface
{
    public function execute(array $input, array &$output): int
    {
        $name = $input[0] ?? null;
        if (!$name) {
            StylizedPrinter::error('Please provide a flow name.');
            return 1;
        }
        $missing = FlowManager::validate($name);
        if (empty($missing) || (count($missing) === 1 && str_contains($missing[0], 'not found'))) {
            StylizedPrinter::info("Flow '$name' is valid.");
            return 0;
        }
        StylizedPrinter::warn("Flow '$name' is missing directives:");
        foreach ($missing as $d) {
            StylizedPrinter::print('  @' . $d, 'module');
        }
        return 1;
    }

    public function name(): string
    {
        return 'flow:validate';
    }

    public function description(): string
    {
        return 'Validate a flow and report missing directives.';
    }
}
