<?php
namespace Mynorel\Rewind;

/**
 * Rewind: Time travel debugging for Mynorel.
 * Records and replays scenes (actions).
 */
class Rewind
{
    protected static array $history = [];

    /**
     * Record a scene (action).
     */
    public static function record(string $scene, $data): void
    {
        self::$history[] = ['scene' => $scene, 'data' => $data, 'time' => microtime(true)];
    }

    /**
     * Replay all recorded scenes.
     */
    public static function replay(callable $callback): void
    {
        foreach (self::$history as $entry) {
            $callback($entry['scene'], $entry['data'], $entry['time']);
        }
    }

    /**
     * Clear the history.
     */
    public static function clear(): void
    {
        self::$history = [];
    }
}
