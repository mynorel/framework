<?php
namespace Mynorel\Testing\Snapshot;

/**
 * SnapshotTest: Narrative snapshot testing for Mynorel.
 * Compare output to stored snapshots for regression detection.
 */
class SnapshotTest {
    /**
     * Compare two files for snapshot testing from the CLI.
     */
    /**
     * Compare two files for snapshot testing from the CLI, with summary and CI output.
     * @param string $outputFile
     * @param string $snapshotFile
     * @param bool $ciOutput
     */
    public static function compare($outputFile, $snapshotFile, bool $ciOutput = false) {
        if (!file_exists($outputFile)) {
            $msg = "[error] Output file not found: $outputFile";
            echo "\n$msg\n";
            if ($ciOutput) echo "::error ::$msg\n";
            return;
        }
        $output = file_get_contents($outputFile);
        try {
            self::assertMatchesSnapshot($output, $snapshotFile, $ciOutput);
        } catch (\Exception $e) {
            echo $e->getMessage() . "\n";
            if ($ciOutput) echo "::error ::Snapshot mismatch: {$e->getMessage()}\n";
        }
    }
    /**
     * Assert that output matches the snapshot, with CI output.
     * @param string $output
     * @param string $snapshotFile
     * @param bool $ciOutput
     */
    public static function assertMatchesSnapshot($output, $snapshotFile, bool $ciOutput = false) {
        $expected = file_exists($snapshotFile) ? file_get_contents($snapshotFile) : '';
        if ($output !== $expected) {
            $msg = "📝 Snapshot mismatch!\nExpected:\n$expected\nActual:\n$output\n";
            echo "\n$msg";
            if ($ciOutput) echo "::error ::Snapshot mismatch\n";
            throw new \Exception("Snapshot mismatch. Update the snapshot if intentional.");
        } else {
            $msg = "📝 Snapshot matches!";
            echo "\n$msg\n";
            if ($ciOutput) echo "::notice ::$msg\n";
        }
    }
}
