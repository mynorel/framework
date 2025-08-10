<?php
namespace Mynorel\Facades;

use Mynorel\Academy\AcademyService;

/**
 * Academy: Facade for onboarding and tutorials.
 */
class Academy
{
    public static function startTutorial()
    {
        return AcademyService::startTutorial();
    }
}
