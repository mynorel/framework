<?php
namespace Mynorel\Console\Commands;

use Mynorel\Console\Contracts\CommandInterface;
use Mynorel\Console\Output\StylizedPrinter;
use Mynorel\Plotline\Core\Plot;

/**
 * PlotlineCommand: Maps out the plotlines (models/ORM) in the application.
 */
class PlotlineCommand implements CommandInterface
{
    public function execute(array $input, array &$output): int
    {
        StylizedPrinter::info('Plotlines in your story:');
        $plots = Plot::all();
        foreach ($plots as $plotClass) {
            $short = (new \ReflectionClass($plotClass))->getShortName();
            StylizedPrinter::print(' - ' . $short);
        }
        return 0;
    }

    public function name(): string
    {
        return 'plotline:map';
    }

    public function description(): string
    {
        return 'Map out the plotlines (models/ORM) in the application.';
    }
}
