<?php
namespace Mynorel\Console\Commands;

use Mynorel\Console\Contracts\CommandInterface;
use Mynorel\Epic\Epic;

class EpicCommand implements CommandInterface
{
    public function name(): string { return 'epic'; }
    public function description(): string { return 'Run or list narrative epics (jobs/tasks)'; }
    public function execute(array $input, array &$output): int
    {
        if (isset($input[0]) && $input[0] === 'list') {
            $epics = Epic::list();
            foreach ($epics as $name) {
                echo \Mynorel\ThemeSkins\ThemeSkins::format("- $name\n");
            }
            return 0;
        }
        if (isset($input[0])) {
            Epic::start($input[0], ...array_slice($input, 1));
            return 0;
        }
    echo \Mynorel\ThemeSkins\ThemeSkins::format("Usage: epic <name> [args...] | epic list\n");
        return 1;
    }
}
