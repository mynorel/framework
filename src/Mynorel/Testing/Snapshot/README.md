# Snapshot Testing

Snapshot testing for Mynorel: compare output to stored snapshots for regression detection.

- Use `SnapshotTest::assertMatchesSnapshot($output, $snapshotFile)`
- Store snapshots in your test directory
- Narrative output for mismatches
