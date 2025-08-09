<?php
namespace Mynorel\Console\Commands;

use Mynorel\Console\Contracts\CommandInterface;
use Mynorel\Console\Output\StylizedPrinter;
use Mynorel\Console\Output\SyntaxColorizer;
use Mynorel\Facades\Manifest;

/**
 * ManifestCommand: Introspect framework modules and meta-information.
 */
class ManifestCommand implements CommandInterface
{
    public function execute(array $input, array &$output): int
    {
        $modules = Manifest::modules();
        $philosophy = Manifest::philosophy();
        $desc = Manifest::describe();

        StylizedPrinter::info('Mynorel Manifest:');
        StylizedPrinter::print('Modules:');
        foreach ($modules as $name => $meta) {
            $line = " - $name: ".$meta['description'].(isset($meta['namespace']) ? " (".$meta['namespace'].")" : '');
            StylizedPrinter::print($line, 'module');
        }
        StylizedPrinter::print('');
        StylizedPrinter::info('Philosophy:');
        foreach ($philosophy as $key => $value) {
            $line = ucfirst($key) . ': ' . $value;
            StylizedPrinter::print($line, 'philosophy');
        }
        return 0;
    }

    public function name(): string
    {
        return 'manifest';
    }

    public function description(): string
    {
        return 'Show framework modules and meta-information.';
    }
}
