<?php
namespace Mynorel\Console\Commands;

use Mynorel\Stylist\StylistService;
use Mynorel\Console\Output\StylizedPrinter;

class StylistWatchCommand implements \Mynorel\Console\Contracts\CommandInterface
{
    public function name(): string { return 'stylist:watch'; }
    public function description(): string { return 'Watch and auto-compile CSS using Stylist.'; }
    public function execute(array $input, array $output): int
    {
        $type = $input['type'] ?? null;
        $in = $input['input'] ?? null;
        $out = $input['output'] ?? null;
        if (!$type || !$in || !$out) {
            StylizedPrinter::warn('Usage: php mynorel stylist:watch --type=sass --input=src.scss --output=out.css');
            return 1;
        }
        StylizedPrinter::poetic("Watching $in for changes...");
        $lastHash = null;
        while (true) {
            clearstatcache();
            $hash = md5_file($in);
            if ($hash !== $lastHash) {
                try {
                    StylistService::compile($type, $in, $out, $input);
                    StylizedPrinter::poetic("Recompiled $type: $in → $out");
                } catch (\Throwable $e) {
                    StylizedPrinter::warn('Stylist error: ' . $e->getMessage());
                }
                $lastHash = $hash;
            }
            usleep(500000); // 0.5s
        }
    }
}
