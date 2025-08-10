<?php
namespace Mynorel\Console\Commands;

use Mynorel\Facades\Media;
use Mynorel\Facades\Author;
use Mynorel\Facades\Chronicle;
use Mynorel\Console\Output\StylizedPrinter;
use Mynorel\Support\Validator;

class MediaListCommand implements \Mynorel\Console\Contracts\CommandInterface
{
    public function name(): string { return 'media:list'; }
    public function description(): string { return 'List all media assets.'; }
    public function execute(array $input, array $output): int
    {
        $user = $input['user'] ?? null;
        if (!Validator::require($user, 'user', 'media:list')) {
            return 1;
        }
        if (!Author::can('media.list', $user)) {
            StylizedPrinter::warn('You do not have permission to list media.');
            Chronicle::warn('Unauthorized media:list attempt.');
            return 1;
        }
        $media = Media::list();
        StylizedPrinter::poetic('The media assets of your narrative:');
        foreach ($media as $item) {
            StylizedPrinter::info("- $item");
        }
        Chronicle::note('Media list viewed.');
        return 0;
    }
}
