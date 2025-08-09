<?php
namespace Mynorel\Chronicle\Channels;

use Mynorel\Chronicle\LogEntry;

/**
 * MemoryChannel: Stores log entries in memory for retrieval/testing.
 */
class MemoryChannel
{
    protected static array $entries = [];

    public static function send(LogEntry $entry): void
    {
        self::$entries[] = $entry;
    }

    public static function all(): array
    {
        return self::$entries;
    }
}
