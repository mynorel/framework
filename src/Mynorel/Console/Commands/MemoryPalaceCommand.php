<?php

namespace Mynorel\Console\Commands;

use Mynorel\Console\Contracts\CommandInterface;
use Mynorel\Scriptorium\Scriptorium;

class MemoryPalaceCommand implements CommandInterface
{
    public function name(): string
    {
        return 'memorypalace';
    }

    public function description(): string
    {
        return 'Interact with the MemoryPalace cache: inscribe, recall, forget, clear.';
    }

    /**
     * Execute the command.
     * @param array $input
     * @param array $output
     * @return int
     */
    public function execute(array $input, array &$output): int
    {
        $action = $input[0] ?? null;
        $key = $input[1] ?? null;
        $value = $input[2] ?? null;
        $cache = Scriptorium::make('memorypalace');

        switch ($action) {
            case 'inscribe':
                if ($key && $value) {
                    $cache->inscribe($key, $value);
                    echo "[MemoryPalace] Inscribed: $key => $value\n";
                } else {
                    echo "Usage: memorypalace inscribe {key} {value}\n";
                }
                break;
            case 'recall':
                if ($key) {
                    $result = $cache->recall($key);
                    if ($result !== null) {
                        echo "[MemoryPalace] $key => $result\n";
                    } else {
                        echo "[MemoryPalace] $key not found.\n";
                    }
                } else {
                    echo "Usage: memorypalace recall {key}\n";
                }
                break;
            case 'forget':
                if ($key) {
                    $cache->forget($key);
                    echo "[MemoryPalace] Forgot: $key\n";
                } else {
                    echo "Usage: memorypalace forget {key}\n";
                }
                break;
            case 'clear':
                $cache->clear();
                echo "[MemoryPalace] Cleared all entries.\n";
                break;
            default:
                echo "Unknown action. Use: inscribe, recall, forget, clear.\n";
        }
        return 0;
    }
}
