<?php
namespace Mynorel\Console\Commands;

use Mynorel\Console\Contracts\CommandInterface;
use Mynorel\Dev\Doctor\DoctorCLI;

/**
 * DoctorCommand: Diagnose and fix common Mynorel issues from the CLI.
 */
class DoctorCommand implements CommandInterface
{
    public function name(): string { return 'doctor'; }
    public function description(): string { return 'Diagnose and fix common Mynorel issues.'; }
    public function execute(array $input, array &$output): int
    {
        DoctorCLI::run();
        $output[] = "Doctor check complete.";
        return 0;
    }
}
