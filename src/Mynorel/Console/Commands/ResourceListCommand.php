<?php
namespace Mynorel\Console\Commands;

use Mynorel\Facades\Resource;
use Mynorel\Facades\Author;
use Mynorel\Facades\Chronicle;
use Mynorel\Console\Output\StylizedPrinter;
use Mynorel\Support\Validator;

class ResourceListCommand implements \Mynorel\Console\Contracts\CommandInterface
{
    public function name(): string { return 'resource:list'; }
    public function description(): string { return 'List all resources (narrative cast and props).'; }
    public function execute(array $input, array $output): int
    {
        $user = $input['user'] ?? null;
        if (!Validator::require($user, 'user', 'resource:list')) {
            return 1;
        }
        if (!Author::can('resource.list', $user)) {
            StylizedPrinter::warn('You do not have permission to list resources.');
            Chronicle::warn('Unauthorized resource:list attempt.');
            return 1;
        }
        $resources = Resource::list();
        StylizedPrinter::poetic('The cast and props of your story:');
        foreach ($resources as $resource) {
            StylizedPrinter::info("- $resource");
        }
        Chronicle::note('Resource list viewed.');
        return 0;
    }
}
