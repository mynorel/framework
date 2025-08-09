<?php
namespace Mynorel\Facades;

use Mynorel\Scriptorium\Scriptorium;

/**
 * Herald Facade: Expressive access to the WebSocket layer.
 */
class Herald
{
    public static function start(int $port = 8080): void
    {
        Scriptorium::make('herald')->start($port);
    }

    public static function broadcast(string $channel, string $message): void
    {
        Scriptorium::make('herald')->broadcast($channel, $message);
    }

    public static function listen(string $channel, callable $callback): void
    {
        Scriptorium::make('herald')->listen($channel, $callback);
    }
}
