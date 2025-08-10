<?php
namespace Mynorel\Console\Commands;

use Mynorel\Console\Contracts\CommandInterface;

/**
 * AcademyCommand: Launch Mynorel Academy onboarding and tutorials.
 */
class AcademyCommand implements CommandInterface
{
    public function name(): string { return 'academy'; }
    public function description(): string { return 'Launch Mynorel Academy onboarding and tutorials.'; }
    public function execute(array $input, array &$output): int
    {
        $output[] = "Welcome to Mynorel Academy! (interactive onboarding coming soon)";
        return 0;
    }
}
