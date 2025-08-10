<?php
namespace Mynorel\Facades;

use Mynorel\Testing\Snapshot\SnapshotTest;

/**
 * Snapshot: Facade for snapshot testing.
 */
class Snapshot
{
    public static function compare($outputFile, $snapshotFile)
    {
        return SnapshotTest::compare($outputFile, $snapshotFile);
    }
    public static function assertMatches($output, $snapshotFile)
    {
        return SnapshotTest::assertMatchesSnapshot($output, $snapshotFile);
    }
}
