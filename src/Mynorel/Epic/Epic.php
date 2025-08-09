<?php
namespace Mynorel\Epic;

/**
 * Epic: Narrative job/task system for Mynorel.
 * Jobs are "epics" and background tasks are "side quests."
 */
class Epic
{
    protected static array $epics = [];


    /**
     * Register a new epic (job/task).
     */
    public static function register(string $name, callable $callback): void
    {
        self::$epics[$name] = $callback;
    }

    /**
     * List all registered epics.
     */
    public static function list(): array
    {
        return array_keys(self::$epics);
    }

    /**
     * Start an epic (job/task).
     */
    public static function start(string $name, ...$args): void
    {
        if (isset(self::$epics[$name])) {
            echo \Mynorel\ThemeSkins\ThemeSkins::format("[Epic '$name' begins]" . PHP_EOL);
            self::$epics[$name](...$args);
            echo \Mynorel\ThemeSkins\ThemeSkins::format("[Epic '$name' completed]" . PHP_EOL);
        } else {
            echo \Mynorel\ThemeSkins\ThemeSkins::format("[Epic '$name' not found]" . PHP_EOL);
        }
    }
}
