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
        $pluginNames = array_map(fn($p) => explode(' ', $p)[0], $plugins);
        if (isset($input[0]) && $input[0] === 'install') {
            $plugin = $input[1] ?? null;
            if (!$plugin) {
                // Interactive fuzzy prompt for plugin name
                $plugin = \Mynorel\Console\Support\InteractivePrompt::ask('Enter plugin to install', '', $pluginNames);
            }
            $plugin = \Mynorel\Console\Support\Security::sanitizeInput($plugin);
            $result = MarketplaceService::install($plugin);
            $output[] = $result . "\n";
            return 0;
        }
        $output[] = "Available plugins:";
        foreach ($plugins as $plugin) {
            $output[] = "- $plugin";
        }
        $output[] = "\nTo install: php mynorel marketplace install <plugin>\n";
        return 0;
    }
}
