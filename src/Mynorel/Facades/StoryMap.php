<?php
namespace Mynorel\Facades;

use Mynorel\Narrative\StoryMap\StoryMapService;

/**
 * StoryMap: Facade for narrative structure export/import/summary.
 */
class StoryMap
{
    public static function export()
    {
        return StoryMapService::export();
    }

    public static function import(string $json)
    {
        return StoryMapService::import($json);
    }

    public static function summary(): string
    {
        return StoryMapService::summary();
    }
}
