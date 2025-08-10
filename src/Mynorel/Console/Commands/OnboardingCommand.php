<?php
namespace Mynorel\Console\Commands;

use Mynorel\Console\Output\StylizedPrinter;
use Mynorel\Facades\System;
use Mynorel\Facades\Theme;
use Mynorel\Facades\Narrative;
use Mynorel\Facades\Author;
use Mynorel\Facades\Chronicle;
use Mynorel\Facades\Resource;
use Mynorel\Facades\Plugin;
use Mynorel\Facades\Notification;
use Mynorel\Facades\Api;

class OnboardingCommand implements \Mynorel\Console\Contracts\CommandInterface
{
    public function name(): string { return 'onboarding'; }
    public function description(): string { return 'Guided onboarding for new Mynorel users.'; }
    public function execute(array $input, array $output): int
    {
    StylizedPrinter::poetic("Welcome to Mynorel! Let's begin your story.");
    StylizedPrinter::info("1. Checking system requirements...");
    StylizedPrinter::info("PHP version: " . phpversion());
    StylizedPrinter::info("Mynorel version: " . (method_exists(System::class, 'version') ? System::version() : 'dev'));
    StylizedPrinter::poetic("2. Setting up your first character (model)...");
    StylizedPrinter::info("Try: php mynorel make:model Hero");
    StylizedPrinter::poetic("3. Creating your first scene (controller)...");
    StylizedPrinter::info("Try: php mynorel make:controller WelcomeController");
    StylizedPrinter::poetic("4. Exploring narrative features:");
    StylizedPrinter::info("- Use Facades: Narrative::chapter('intro'), Author::can('edit', <user>)");
    StylizedPrinter::info("- Use CLI: php mynorel resource:list, php mynorel plugin:activate");
    StylizedPrinter::info("- Use Myneral templates for narrative UI");
    StylizedPrinter::poetic("5. See docs/README.md for more, or run 'php mynorel tour' for a guided demo.");
    StylizedPrinter::poetic("Onboarding complete! Your narrative begins now.");
        return 0;
    }
}
