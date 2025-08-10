<?php
namespace Mynorel\Console\Commands;

use Mynorel\Facades\Plugin;
use Mynorel\Facades\Author;
use Mynorel\Facades\Chronicle;
use Mynorel\Console\Output\StylizedPrinter;
use Mynorel\Support\Validator;

class PluginListCommand implements \Mynorel\Console\Contracts\CommandInterface
{
    public function name(): string { return 'plugin:list'; }
    public function description(): string { return 'List all plugins and themes.'; }
    public function execute(array $input, array &$output): int
    {
        $user = $input['user'] ?? null;
        if (!Validator::require($user, 'user', 'plugin:list')) {
            return 1;
        }
        if (!Author::can('plugin.list', $user)) {
            StylizedPrinter::warn('You do not have permission to list plugins.');
            Chronicle::warn('Unauthorized plugin:list attempt.');
            return 1;
        }
        $plugins = Plugin::list();
        StylizedPrinter::poetic('The side stories and themes of your narrative:');
        foreach ($plugins as $plugin) {
            StylizedPrinter::info("- $plugin");
        }
        Chronicle::note('Plugin list viewed.');
        return 0;
    }
}
