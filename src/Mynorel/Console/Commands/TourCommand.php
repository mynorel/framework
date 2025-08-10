<?php
namespace Mynorel\Console\Commands;

use Mynorel\Console\Output\StylizedPrinter;

class TourCommand implements \Mynorel\Console\Contracts\CommandInterface
{
    public function name(): string { return 'tour'; }
    public function description(): string { return 'Take a guided tour of Mynorel features.'; }
    public function execute(array $input, array &$output): int
    {
        StylizedPrinter::poetic("Welcome to the Mynorel Tour!");
        StylizedPrinter::info("1. Models are characters. Try: php myne make:model Hero");
        StylizedPrinter::info("2. Controllers are narrators. Try: php myne make:controller WelcomeController");
        StylizedPrinter::info("3. Use Facades for narrative logic. Try: Narrative::chapter('intro')");
        StylizedPrinter::info("4. Use CLI for all features. Try: php myne resource:list --user=alice");
    StylizedPrinter::info("5. Templates are stories. Edit a .myneral.php file and render with Myneral.");
        StylizedPrinter::info("6. Explore plugins, billing, cloud, and more via CLI and Facades.");
        StylizedPrinter::poetic("Your narrative is yours to write. See docs/ for more.");
        return 0;
    }
}
