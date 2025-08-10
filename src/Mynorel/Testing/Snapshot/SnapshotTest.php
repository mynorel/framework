<?php
namespace Mynorel\Testing\Snapshot;

/**
 * SnapshotTest: Narrative snapshot testing for Mynorel.
 * Compare output to stored snapshots for regression detection.
 */
class SnapshotTest {
    public static function assertMatchesSnapshot($output, $snapshotFile) {
        $expected = file_exists($snapshotFile) ? file_get_contents($snapshotFile) : '';
        if ($output !== $expected) {
            throw new \Exception("Snapshot mismatch. Update the snapshot if intentional.");
        }
    }
    // ...narrative snapshot logic...
}
