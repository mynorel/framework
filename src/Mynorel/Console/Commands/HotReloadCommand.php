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
        $path = $input[0] ?? 'src/Mynorel/Myneral/Layouts';
        ob_start();
        HotReloadService::watch($path);
        $result = ob_get_clean();
        $output[] = $result;
        return 0;
    }
}
