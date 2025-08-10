<?php
namespace Mynorel\Console\Commands;

use Mynorel\Console\Contracts\CommandInterface;
use Mynorel\Testing\Snapshot\SnapshotTest;

/**
 * SnapshotTestCommand: Run a snapshot test from the CLI.
 */
class SnapshotTestCommand implements CommandInterface
{
    public function name(): string { return 'test:snapshot'; }
    public function description(): string { return 'Run a snapshot test.'; }
    public function execute(array $input, array &$output): int
    {
        // Example usage: php myne test:snapshot output.txt snapshot.snap
        $output[] = "Snapshot test stub (integrate with your test suite).";
        return 0;
    }
}
