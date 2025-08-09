<?php
namespace Mynorel\Plotline\Chapters;

use Mynorel\Plotline\Core\Outline;

/**
 * Chapter: Migration class for structural changes (migrations).
 */
abstract class Chapter
{
    abstract public function write(): void;

    protected function create(string $table, callable $callback): array
    {
        $outline = new Outline();
        $callback($outline);
        return [
            'table' => $table,
            'fields' => $outline->getFields(),
        ];
    }
}
