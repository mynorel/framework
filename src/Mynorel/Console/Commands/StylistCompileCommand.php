<?php
namespace Mynorel\Console\Commands;

use Mynorel\Stylist\StylistService;
use Mynorel\Console\Output\StylizedPrinter;

class StylistCompileCommand implements \Mynorel\Console\Contracts\CommandInterface
{
    public function name(): string { return 'stylist:compile'; }
    public function description(): string { return 'Compile CSS using Stylist (Tailwind, Sass, Less, PostCSS, CSS).'; }
    public function execute(array $input, array $output): int
    {
        $type = $input['type'] ?? null;
        $in = $input['input'] ?? null;
        $out = $input['output'] ?? null;
        if (!$type || !$in || !$out) {
            StylizedPrinter::warn('Usage: php mynorel stylist:compile --type=sass --input=src.scss --output=out.css');
            return 1;
        }
        try {
            StylistService::compile($type, $in, $out, $input);
            StylizedPrinter::poetic("Compiled $type: $in → $out");
            return 0;
        } catch (\Throwable $e) {
            StylizedPrinter::warn('Stylist error: ' . $e->getMessage());
            return 1;
        }
    }
}
