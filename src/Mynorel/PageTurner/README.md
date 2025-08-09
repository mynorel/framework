# PageTurner (Narrative Pagination)

PageTurner is Mynorel’s narrative pagination system. Each page is a chapter, each turn a new view. Use it to paginate lists, models, or any collection in a poetic, expressive way.

## Usage

```php
use Mynorel\PageTurner\PageTurner;

$items = range(1, 100);
$paginator = new PageTurner($items, 10, 1); // 10 per page, start at page 1

// Get items for the current chapter (page)
$current = $paginator->currentChapter();

// Go to the next chapter (page)
$next = $paginator->nextChapter();

// Get total chapters (pages)
$total = $paginator->totalChapters();
```

## Philosophy
- Every list is a story, every page a chapter.
- Pagination is a narrative journey.

---
*"Turn the page, continue the story."*
