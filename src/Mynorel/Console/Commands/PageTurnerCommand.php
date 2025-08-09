<?php
namespace Mynorel\Console\Commands;

use Mynorel\Console\Contracts\CommandInterface;
use Mynorel\PageTurner\PageTurner;

class PageTurnerCommand implements CommandInterface
{
    public function name(): string { return 'paginate'; }
    public function description(): string { return 'Paginate and view lists or models (turn the page)'; }
    public function execute(array $input, array &$output): int
    {
        if (empty($input)) {
            echo "Usage: paginate <comma-separated-values> [perPage] [page]\n";
            return 1;
        }
        $items = explode(',', $input[0]);
        $perPage = isset($input[1]) ? (int)$input[1] : 10;
        $page = isset($input[2]) ? (int)$input[2] : 1;
        $paginator = new PageTurner($items, $perPage, $page);
        echo "Page {$paginator->currentPage()} of {$paginator->totalChapters()}\n";
        foreach ($paginator->currentChapter() as $item) {
            echo "- $item\n";
        }
        if (!$paginator->isFirstChapter()) {
            echo "[prev: paginate <items> $perPage " . ($page-1) . "] ";
        }
        if (!$paginator->isLastChapter()) {
            echo "[next: paginate <items> $perPage " . ($page+1) . "]";
        }
        echo "\n";
        return 0;
    }
}
