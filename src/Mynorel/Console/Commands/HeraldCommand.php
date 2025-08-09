<?php
namespace Mynorel\Console\Commands;

use Mynorel\Console\Contracts\CommandInterface;
use Mynorel\Scriptorium\Scriptorium;

/**
 * HeraldCommand: CLI for real-time narrative (WebSocket) operations.
 */
class HeraldCommand implements CommandInterface
{
    public function name(): string
    {
        return 'herald';
    }

    public function description(): string
    {
        return 'Start, broadcast, or listen with the Herald (WebSocket layer).';
    }

    public function execute(array $input, array &$output): int
    {
        $action = $input[0] ?? null;
        $arg1 = $input[1] ?? null;
        $arg2 = $input[2] ?? null;
        $herald = Scriptorium::make('herald');

        switch ($action) {
            case 'start':
                $port = $arg1 ? (int)$arg1 : 8080;
                $herald->start($port);
                break;
            case 'broadcast':
                if ($arg1 && $arg2) {
                    $herald->broadcast($arg1, $arg2);
                } else {
                    echo "Usage: herald broadcast {channel} {message}\n";
                }
                break;
            case 'listen':
                if ($arg1) {
                    $herald->listen($arg1, function($msg) {
                        echo "[Herald] Received: $msg\n";
                    });
                } else {
                    echo "Usage: herald listen {channel}\n";
                }
                break;
            default:
                echo "herald [start {port}] | [broadcast {channel} {message}] | [listen {channel}]\n";
        }
        return 0;
    }
}
