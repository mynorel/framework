<?php
namespace Mynorel\Console\Commands;

use Mynorel\Console\Contracts\CommandInterface;
use Mynorel\Console\Output\StylizedPrinter;

/**
 * TestCommand: Runs the Mynorel test suite with narrative output.
 */
class TestCommand implements CommandInterface
{
    public function execute(array $input, array &$output): int
    {
        StylizedPrinter::poetic("[Prelude] The tale of tests begins...");

        $phpunit = './vendor/bin/phpunit';
        if (!file_exists($phpunit)) {
            StylizedPrinter::warn("[Warning] PHPUnit is not installed. Run: composer require --dev phpunit/phpunit");
            return 1;
        }

        StylizedPrinter::info("[Narrator] Summoning PHPUnit...");
        passthru("$phpunit --colors=always", $exitCode);

        if ($exitCode === 0) {
            StylizedPrinter::poetic("[Finale] All tests passed. The story continues!");
        } else {
            StylizedPrinter::error("[Cliffhanger] Some tests failed. The plot thickens.");
        }
        return $exitCode;
    }

    public function name(): string
    {
        return 'test';
    }

    public function description(): string
    {
        return 'Run the Mynorel test suite (PHPUnit) with narrative output.';
    }
}
