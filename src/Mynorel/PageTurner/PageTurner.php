<?php
namespace Mynorel\PageTurner;

/**
 * PageTurner: Narrative pagination for Mynorel.
 * Each page is a chapter, each turn a new view.
 */

class PageTurner
{
    protected array $items;
    protected int $perPage;
    protected int $currentPage;

    /**
     * Cursor-based pagination: get items after a given cursor (offset or key).
     * Returns ['items' => [...], 'next_cursor' => int|null, 'prev_cursor' => int|null]
     */
    public function cursorChapter($cursor = 0, $limit = null): array
    {
        $limit = $limit ?? $this->perPage;
        $start = (int)$cursor;
        $items = array_slice($this->items, $start, $limit);
        $next = ($start + $limit < count($this->items)) ? $start + $limit : null;
        $prev = ($start - $limit >= 0) ? $start - $limit : null;
        return [
            'items' => $items,
            'next_cursor' => $next,
            'prev_cursor' => $prev
        ];
    }

    /**
     * Get a narrative summary of the current chapter.
     */
    public function chapterSummary(): string
    {
        $total = $this->totalChapters();
        $current = $this->currentPage;
        $first = $this->isFirstChapter() ? ' (Prologue)' : '';
        $last = $this->isLastChapter() ? ' (Finale)' : '';
        return "Chapter $current of $total$first$last";
    }

    /**
     * Get a narrative progress bar for the current chapter.
     */
    public function progressBar(int $width = 20): string
    {
        $total = $this->totalChapters();
        $current = $this->currentPage;
        $filled = (int) round(($current / $total) * $width);
        return '[' . str_repeat('=', $filled) . str_repeat(' ', $width - $filled) . "] $current/$total]";
    }
    /**
     * Get the total number of items.
     */
    public function itemsTotal(): int
    {
        return count($this->items);
    }

    /**
     * Is this the first chapter (page)?
     */
    public function isFirstChapter(): bool
    {
        return $this->currentPage === 1;
    }

    /**
     * Is this the last chapter (page)?
     */
    public function isLastChapter(): bool
    {
        return $this->currentPage === $this->totalChapters();
    }

    public function __construct(array $items, int $perPage = 10, int $currentPage = 1)
    {
        $this->items = $items;
        $this->perPage = $perPage;
        $this->currentPage = max(1, $currentPage);
    }

    /**
     * Get items for the current page (chapter).
     */
    public function currentChapter(): array
    {
        $offset = ($this->currentPage - 1) * $this->perPage;
        return array_slice($this->items, $offset, $this->perPage);
    }

    /**
     * Get the total number of pages (chapters).
     */
    public function totalChapters(): int
    {
        return (int) ceil(count($this->items) / $this->perPage);
    }

    /**
     * Go to the next page (chapter).
     */
    public function nextChapter(): self
    {
        return new self($this->items, $this->perPage, min($this->currentPage + 1, $this->totalChapters()));
    }

    /**
     * Go to the previous page (chapter).
     */
    public function previousChapter(): self
    {
        return new self($this->items, $this->perPage, max($this->currentPage - 1, 1));
    }

    /**
     * Get the current page (chapter) number.
     */
    public function currentPage(): int
    {
        return $this->currentPage;
    }
}
