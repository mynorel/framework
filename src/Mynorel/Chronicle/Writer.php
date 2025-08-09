<?php
namespace Mynorel\Chronicle;

use Mynorel\Chronicle\LogEntry;
use Mynorel\Chronicle\Channels\MemoryChannel;
use Mynorel\Chronicle\Channels\FileChannel;
use Mynorel\Chronicle\Formatters\PoeticFormatter;

/**
 * Writer: Core logic for logging events in Mynorel's narrative style.
 * Handles log entry creation, formatting, and channel dispatch.
 */
class Writer
{
    /**
     * @var LogEntry[]
     */
    protected static array $entries = [];

    /**
     * @var array List of channel class names
     */
    protected static array $channels = [MemoryChannel::class, FileChannel::class];

    /**
     * @var string Formatter class name
     */
    protected static string $formatter = PoeticFormatter::class;

    /**
     * Write a log entry.
     * @param string $level
     * @param string $message
     * @param string|null $chapter
     */
    public static function write(string $level, string $message, ?string $chapter = null): void
    {
        $entry = new LogEntry($level, $message, $chapter);
        self::$entries[] = $entry;
        // Send to all channels
        foreach (self::$channels as $channel) {
            if (class_exists($channel) && method_exists($channel, 'send')) {
                $channel::send($entry);
            }
        }
        // Format and echo (for CLI/dev)
        if (class_exists(self::$formatter) && method_exists(self::$formatter, 'format')) {
            echo self::$formatter::format($entry) . "\n";
        } else {
            echo "[{$level}] {$message}\n";
        }
    }

    /**
     * Register a new channel.
     * @param string $channelClass
     */
    public static function addChannel(string $channelClass): void
    {
        if (!in_array($channelClass, self::$channels)) {
            self::$channels[] = $channelClass;
        }
    }

    /**
     * Set the formatter class.
     * @param string $formatterClass
     */
    public static function setFormatter(string $formatterClass): void
    {
        self::$formatter = $formatterClass;
    }

    /**
     * Get all log entries (prefer persistent FileChannel if available).
     * @return LogEntry[]
     */
    public static function all(): array
    {
        if (class_exists(FileChannel::class) && method_exists(FileChannel::class, 'all')) {
            $fileEntries = FileChannel::all();
            if (!empty($fileEntries)) return $fileEntries;
        }
        return self::$entries;
    }
}
