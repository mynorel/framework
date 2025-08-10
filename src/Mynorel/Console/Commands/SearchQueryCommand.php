<?php
namespace Mynorel\Console\Commands;

use Mynorel\Facades\Search;
use Mynorel\Facades\Author;
use Mynorel\Facades\Chronicle;
use Mynorel\Console\Output\StylizedPrinter;
use Mynorel\Support\Validator;

class SearchQueryCommand implements \Mynorel\Console\Contracts\CommandInterface
{
    public function name(): string { return 'search:query'; }
    public function description(): string { return 'Search the narrative and resources.'; }
    public function execute(array $input, array $output): int
    {
        $user = $input['user'] ?? null;
        $query = $input['query'] ?? null;
        if (!Validator::require($user, 'user', 'search:query') || !Validator::require($query, 'query', 'search:query')) {
            return 1;
        }
        if (!Author::can('search.query', $user)) {
            StylizedPrinter::warn('You do not have permission to search.');
            Chronicle::warn('Unauthorized search:query attempt.');
            return 1;
        }
        $results = Search::search($query);
        StylizedPrinter::poetic("Search results for '$query':");
        foreach ($results as $result) {
            StylizedPrinter::info("- $result");
        }
        Chronicle::note("Search performed for '$query'.");
        return 0;
    }
}
