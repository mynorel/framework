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
