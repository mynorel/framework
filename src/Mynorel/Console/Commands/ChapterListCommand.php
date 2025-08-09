<?php
namespace Mynorel\Console\Commands;

use Mynorel\Console\Contracts\CommandInterface;
use Mynorel\Console\Output\StylizedPrinter;
use Mynorel\Narrative\Narrative;

/**
 * ChapterListCommand: Lists all chapters (routes) in the narrative.
 */
class ChapterListCommand implements CommandInterface
{
    public function execute(array $input, array &$output): int
    {
        StylizedPrinter::info('Chapters in your story:');
        $chapters = Narrative::all();
        foreach ($chapters as $chapter) {
            StylizedPrinter::print(' - ' . $chapter->name);
        }
        return 0;
    }

    public function name(): string
    {
        return 'chapter:list';
    }

    public function description(): string
    {
        return 'List all chapters (routes) in the narrative.';
    }
}
