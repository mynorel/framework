<?php
namespace Mynorel\Console\Commands;

use Mynorel\Console\Contracts\CommandInterface;
use Mynorel\Myneral\HotReload\HotReloadService;

/**
 * HotReloadCommand: Start hot-reloading for Myneral templates.
 */
class HotReloadCommand implements CommandInterface
{
    public function name(): string { return 'myneral:hotreload'; }
    public function description(): string { return 'Start hot-reloading for Myneral templates.'; }
    public function execute(array $input, array &$output): int
    {
        $output[] = "Hot reload stub (integrate with your dev workflow).";
        return 0;
    }
}
