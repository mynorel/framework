<?php
// tests/Testing/SnapshotTestTest.php

use Mynorel\Testing\Snapshot\SnapshotTest;

class SnapshotTestTest extends \PHPUnit\Framework\TestCase {
    public function testAssertMatchesSnapshotMatch() {
        $output = "expected output";
        $snapshotFile = __DIR__ . '/snapshot.snap';
        file_put_contents($snapshotFile, $output);
        $this->expectOutputRegex('/Snapshot matches/');
        SnapshotTest::assertMatchesSnapshot($output, $snapshotFile);
        unlink($snapshotFile);
    }
    public function testAssertMatchesSnapshotMismatch() {
        $output = "actual output";
        $snapshotFile = __DIR__ . '/snapshot.snap';
        file_put_contents($snapshotFile, "expected output");
        $this->expectOutputRegex('/Snapshot mismatch/');
        try {
            SnapshotTest::assertMatchesSnapshot($output, $snapshotFile);
        } catch (\Exception $e) {
            $this->assertStringContainsString('Snapshot mismatch', $e->getMessage());
        }
        unlink($snapshotFile);
    }
}
