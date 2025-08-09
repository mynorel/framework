<?php
namespace Mynorel\Console\Commands;

use Mynorel\Console\Contracts\CommandInterface;
use Mynorel\ThemeSkins\ThemeSkins;

class ThemeSkinCommand implements CommandInterface
{
    public function name(): string { return 'skin'; }
    public function description(): string { return 'List, activate, or preview narrative skins'; }
    public function execute(array $input, array &$output): int
    {
        if (isset($input[0]) && $input[0] === 'list') {
            $skins = ThemeSkins::list();
            foreach ($skins as $name) {
                echo ThemeSkins::format(($name === ThemeSkins::active() ? '* ' : '  ') . $name . "\n");
            }
            return 0;
        }
        if (isset($input[0]) && $input[0] === 'preview' && isset($input[1])) {
            echo ThemeSkins::format($input[1]) . "\n";
            return 0;
        }
        if (isset($input[0])) {
            ThemeSkins::activate($input[0]);
            echo ThemeSkins::format("Skin '{$input[0]}' activated.\n");
            return 0;
        }
    echo ThemeSkins::format("Usage: skin <name> | skin list | skin preview <text>\n");
        return 1;
    }
}
