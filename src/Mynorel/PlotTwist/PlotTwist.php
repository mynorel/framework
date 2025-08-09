<?php
namespace Mynorel\PlotTwist;

/**
 * PlotTwist: Narrative event system for Mynorel.
 * Events are plot twists, listeners are audience reactions.
 */
class PlotTwist
{
    protected static array $listeners = [];

    /**
     * Register a listener (audience reaction) for a plot twist (event).
     */
    public static function on(string $twist, callable $reaction): void
    {
        self::$listeners[$twist][] = $reaction;
    }

    /**
     * Trigger a plot twist (event).
     */
    public static function trigger(string $twist, ...$args): void
    {
        foreach (self::$listeners[$twist] ?? [] as $reaction) {
            $reaction(...$args);
        }
    }
}
