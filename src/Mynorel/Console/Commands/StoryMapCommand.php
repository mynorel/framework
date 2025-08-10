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
        $output[] = "Exporting story map as JSON...";
        $json = StoryMapService::export();
        $output[] = $json;
        return 0;
    }
}
