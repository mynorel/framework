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
        $file = $input[0] ?? 'output.txt';
        $snapshot = $input[1] ?? 'snapshot.snap';
        ob_start();
        SnapshotTest::compare($file, $snapshot);
        $result = ob_get_clean();
        $output[] = $result;
        return 0;
    }
}
