<?php
namespace Mynorel\Console\Commands;

use Mynorel\Console\Contracts\CommandInterface;
use Mynorel\Narrative\StoryMap\StoryMapService;

/**
 * StoryMapCommand: Export or import story maps from the CLI.
 */
class StoryMapCommand implements CommandInterface
{
    public function name(): string { return 'storymap'; }
    public function description(): string { return 'Export or import narrative story maps.'; }
    public function execute(array $input, array &$output): int
    {
        if (isset($input[0]) && $input[0] === 'import' && isset($input[1])) {
            $json = file_get_contents($input[1]);
            $ok = StoryMapService::import($json);
            $output[] = $ok ? "\n\u2705 Story map imported successfully.\n" : "\n\u274C Failed to import story map.\n";
            return 0;
        }
        if (isset($input[0]) && $input[0] === 'summary') {
            $output[] = StoryMapService::summary();
            return 0;
        }
        $output[] = "Exporting story map as JSON...";
        $json = StoryMapService::export();
        $output[] = $json;
        $output[] = "\nTo import: php myne storymap import <file>\nTo summarize: php myne storymap summary\n";
        return 0;
    }
}
