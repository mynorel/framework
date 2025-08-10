<?php
namespace Mynorel\Console\Commands;

use Mynorel\Console\Contracts\CommandInterface;
use Mynorel\Herald\Dashboard\HeraldDashboard;

/**
 * HeraldDashboardCommand: Launch the real-time Herald dashboard from the CLI.
 */
class HeraldDashboardCommand implements CommandInterface
{
    public function name(): string { return 'herald:dashboard'; }
    public function description(): string { return 'Launch the real-time Herald dashboard.'; }
    public function execute(array $input, array &$output): int
    {
        $output[] = HeraldDashboard::render();
        return 0;
    }
}
