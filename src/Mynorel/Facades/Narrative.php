<?php
namespace Mynorel\Facades;

use Mynorel\Narrative\Narrative as NarrativeEngine;

/**
 * Narrative: Facade for onboarding and storytelling.
 */
class Narrative
{
    public static function chapter(string $name)
    {
        return NarrativeEngine::find($name);
    }

    public static function registerDirectives(array $map): void
    {
        // Optional: extend directive engine
    }
}
