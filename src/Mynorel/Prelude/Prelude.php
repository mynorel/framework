<?php
namespace Mynorel\Prelude;

class Prelude
{
    /**
     * Global Preludes (middleware run for every request/flow).
     * @var array
     */
    protected static array $global = [
        \Mynorel\Http\Middleware\CsrfMiddleware::class
    ];

    /**
     * Register one or more global Preludes.
     * @param string|array $preludes
     * @return void
     */
    public static function registerGlobal($preludes): void
    {
        $list = is_array($preludes) ? $preludes : [$preludes];
        foreach ($list as $prelude) {
            if (is_string($prelude) && !in_array($prelude, self::$global, true)) {
                self::$global[] = $prelude;
            }
        }
    }

    /**
     * Run all global Preludes (middleware).
     * @param mixed $context
     * @return void
     */
    public static function runGlobal($context = null): void
    {
        $list = self::$global;
        foreach ($list as $prelude) {
            if (is_string($prelude) && class_exists($prelude)) {
                $instance = new $prelude();
                if (method_exists($instance, 'handle')) {
                    $instance->handle($context);
                }
            }
        }
    }

    /**
     * Static registry for named pipelines (sequences).
     * @var array
     */
    protected static array $sequences = [];

    /**
     * Run one or more Prelude (middleware) classes.
     *
     * @param string|array $preludes
     * @param mixed $context
     * @return void
     */
    public static function run($preludes, $context = null): void
    {
        // Always run global middleware first
        self::runGlobal($context);
        $list = is_array($preludes) ? $preludes : [$preludes];
        foreach ($list as $prelude) {
            if (is_string($prelude) && class_exists($prelude)) {
                $instance = new $prelude();
                if (method_exists($instance, 'handle')) {
                    $instance->handle($context);
                }
            }
        }
    }

    /**
     * Compose a named sequence of Preludes (middleware pipeline).
     *
     * @param string $name
     * @param array $preludes
     * @return void
     */
    public static function compose(string $name, array $preludes): void
    {
        self::$sequences[$name] = $preludes;
    }

    /**
     * Run a named sequence (pipeline) of Preludes.
     *
     * @param string $name
     * @param mixed $context
     * @return void
     */
    public static function sequence(string $name, $context = null): void
    {
        if (isset(self::$sequences[$name])) {
            self::run(self::$sequences[$name], $context);
        }
    }

    /**
     * Run a Sentinel (guard) before a Ritual (handler).
     *
     * @param string $sentinel
     * @param callable $ritual
     * @param mixed $context
     * @return mixed|null
     */
    public static function guard(string $sentinel, callable $ritual, $context = null)
    {
        if (class_exists($sentinel)) {
            $instance = new $sentinel();
            if (method_exists($instance, 'check') && !$instance->check($context)) {
                return null; // Guard failed
            }
        }
        return $ritual($context);
    }

}