<?php
namespace Mynorel\Myneral\Console\Commands;

use Mynorel\Console\Contracts\CommandInterface;

class ViewCacheClearCommand implements CommandInterface
{
    public function execute(array $input, array &$output): int
    {
        $cacheDir = __DIR__ . '/../../../../cache/views/';
        $deleted = 0;
        if (is_dir($cacheDir)) {
            foreach (glob($cacheDir . '*.php') as $file) {
                if (unlink($file)) $deleted++;
            }
        }
        $output[] = "Cleared $deleted cached view file(s).";
        return 0;
    }

    public function name(): string
    {
        return 'view:cache:clear';
    }

    public function description(): string
    {
        return 'Clear all compiled view cache files.';
    }
}
