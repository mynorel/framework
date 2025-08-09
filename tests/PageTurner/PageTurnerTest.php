<?php
// ... PageTurner tests following Mynorel's narrative style ...

use PHPUnit\Framework\TestCase;
use Mynorel\PageTurner\PageTurner;

class PageTurnerTest extends TestCase
{
    public function testCurrentChapterPagination()
    {
        $items = range(1, 10);
        $turner = new PageTurner($items, 3, 1);
        $this->assertEquals([1,2,3], $turner->currentChapter());
        $turner2 = $turner->nextChapter();
        $this->assertEquals([4,5,6], $turner2->currentChapter());
    }

    public function testCursorChapterNavigation()
    {
        $items = ['a', 'b', 'c', 'd'];
        $turner = new PageTurner($items, 2, 1);
        $cursorResult = $turner->cursorChapter(0, 2);
        $this->assertEquals(['a', 'b'], $cursorResult['items']);
        $cursorResult2 = $turner->cursorChapter($cursorResult['next_cursor'], 2);
        $this->assertEquals(['c', 'd'], $cursorResult2['items']);
    }
}
