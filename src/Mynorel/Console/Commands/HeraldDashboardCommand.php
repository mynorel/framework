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
        if (isset($input[0]) && $input[0] === 'simulate' && isset($input[1]) && isset($input[2])) {
            $channel = $input[1];
            $event = $input[2];
            $out = "\n[Herald] Simulating event on channel '$channel': $event\n";
            $out .= "(This would be broadcast to dashboard listeners in a real app.)\n";
            $output[] = $out;
            return 0;
        }
        $output[] = HeraldDashboard::render();
        $output[] = "\nTo simulate: php myne herald:dashboard simulate <channel> <event>\n";
        return 0;
    }
}
