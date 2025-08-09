<?php
namespace Mynorel\Chronicle\Formatters;

use Mynorel\Chronicle\LogEntry;

/**
 * PoeticFormatter: Formats log entries in a narrative, poetic style.
 */
class PoeticFormatter
{
    public static function format(LogEntry $entry): string
    {
        $date = date('M d, H:i', $entry->timestamp);
        $chapter = $entry->chapter ? " in chapter '{$entry->chapter}'" : '';
        switch ($entry->level) {
            case 'info':
                return "[$date] A note$chapter: {$entry->message}";
            case 'warn':
                return "[$date] A shadow falls$chapter: {$entry->message}";
            case 'chapter':
                return "[$date] A new chapter begins: {$entry->message}";
            case 'error':
                return "[$date] An interruption$chapter: {$entry->message}";
            default:
                return "[$date] {$entry->level}$chapter: {$entry->message}";
        }
    }
}
