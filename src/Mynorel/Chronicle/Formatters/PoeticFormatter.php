<?php
namespace Mynorel\Chronicle\Formatters;

use Mynorel\Chronicle\LogEntry;

/**
 * PoeticFormatter: Formats log entries in a narrative, poetic style.
 */
class PoeticFormatter
{
    /**
     * Format a log entry, with optional i18n and actionable suggestions for errors.
     * @param LogEntry $entry
     * @param array $context Optional context with 'locale', 'translations', and 'suggestions'.
     */
    public static function format(LogEntry $entry, array $context = []): string
    {
        $date = date('M d, H:i', $entry->timestamp);
        $chapter = $entry->chapter ? " in chapter '{$entry->chapter}'" : '';
        $locale = $context['locale'] ?? 'en';
        $t = $context['translations'][$locale] ?? [];
        $tr = function($key, $fallback) use ($t) {
            return $t[$key] ?? $fallback;
        };
        $suggestions = $context['suggestions'][$entry->level] ?? [];
        $suggestionText = '';
        if ($entry->level === 'error' && $suggestions) {
            $suggestionText = "\n  → " . $tr('chronicle.suggestion', 'Suggestion:') . ' ' . implode('; ', $suggestions);
        }
        switch ($entry->level) {
            case 'info':
                return "[$date] " . $tr('chronicle.note', 'A note') . "$chapter: {$entry->message}";
            case 'warn':
                return "[$date] " . $tr('chronicle.warn', 'A shadow falls') . "$chapter: {$entry->message}";
            case 'chapter':
                return "[$date] " . $tr('chronicle.chapter', 'A new chapter begins') . ": {$entry->message}";
            case 'error':
                return "[$date] " . $tr('chronicle.error', 'An interruption') . "$chapter: {$entry->message}$suggestionText";
            default:
                return "[$date] {$entry->level}$chapter: {$entry->message}";
        }
    }
}
