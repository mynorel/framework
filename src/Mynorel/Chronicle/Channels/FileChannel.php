<?php
namespace Mynorel\Chronicle\Channels;

use Mynorel\Chronicle\LogEntry;

/**
 * FileChannel: Persists log entries to a file for cross-process access.
 */
class FileChannel
{
    // Use project root storage directory, resolved at runtime
    protected static function logFile(): string
    {
        return getcwd() . '/storage/chronicle.log';
    }

    public static function send(LogEntry $entry): void
    {
        $line = json_encode([
            'level' => $entry->level,
            'message' => $entry->message,
            'chapter' => $entry->chapter,
            'timestamp' => $entry->timestamp,
        ]) . "\n";
        file_put_contents(self::logFile(), $line, FILE_APPEND);
    }

    /**
     * Read all log entries from the file.
     * @return LogEntry[]
     */
    public static function all(): array
    {
        $logFile = self::logFile();
        if (!file_exists($logFile)) return [];
        $lines = file($logFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $entries = [];
        foreach ($lines as $line) {
            $data = json_decode($line, true);
            if ($data) {
                $entry = new LogEntry($data['level'], $data['message'], $data['chapter'] ?? null);
                $entry->timestamp = $data['timestamp'] ?? time();
                $entries[] = $entry;
            }
        }
        return $entries;
    }
}
