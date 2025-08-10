<?php
namespace Mynorel\Console\Commands;

use Mynorel\Console\Contracts\CommandInterface;
use Mynorel\Testing\Mutation\MutationTest;

/**
 * MutationTestCommand: Run mutation tests from the CLI.
 */
class MutationTestCommand implements CommandInterface
{
    public function name(): string { return 'test:mutation'; }
    public function description(): string { return 'Run mutation tests.'; }
    public function execute(array $input, array &$output): int
    {
        $output[] = "Mutation test stub (integrate with your test suite).";
        return 0;
    }
}
