<?php
namespace Mynorel\Chronicle;

/**
 * LogEntry: Represents a single log event in the narrative.
 */
class LogEntry
{
    public string $level;
    public string $message;
    public ?string $chapter;
    public int $timestamp;

    public function __construct(string $level, string $message, ?string $chapter = null)
    {
        $this->level = $level;
        $this->message = $message;
        $this->chapter = $chapter;
        $this->timestamp = time();
    }
}
