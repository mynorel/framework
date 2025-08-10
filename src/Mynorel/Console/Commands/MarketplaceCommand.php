<?php
namespace Mynorel\Console\Commands;

use Mynorel\Console\Contracts\CommandInterface;
use Mynorel\Plugin\Marketplace\MarketplaceService;

/**
 * MarketplaceCommand: Discover and manage Mynorel plugins from the CLI.
 */
class MarketplaceCommand implements CommandInterface
{
    public function name(): string { return 'marketplace'; }
    public function description(): string { return 'Discover, install, and manage Mynorel plugins.'; }
    public function execute(array $input, array &$output): int
    {
        $plugins = MarketplaceService::listPlugins();
        $output[] = "Available plugins:";
        foreach ($plugins as $plugin) {
            $output[] = "- $plugin";
        }
        return 0;
    }
}
