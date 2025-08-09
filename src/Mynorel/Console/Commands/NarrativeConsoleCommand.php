<?php
namespace Mynorel\Console\Commands;

use Mynorel\Console\Contracts\CommandInterface;
use Mynorel\Console\NarrativeConsole;

class NarrativeConsoleCommand implements CommandInterface
{
    public function name(): string { return 'narrative'; }
    public function description(): string { return 'Launch the interactive Narrative Console (story REPL)'; }
    public function execute(array $input, array &$output): int
    {
        NarrativeConsole::start();
        return 0;
    }
}
