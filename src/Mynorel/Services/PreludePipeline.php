<?php
namespace Mynorel\Services;

class PreludePipeline
{
    public static function run(array $preludes, $context = null): void
    {
        foreach ($preludes as $prelude) {
            if (is_string($prelude) && class_exists($prelude)) {
                $instance = new $prelude();
                if (method_exists($instance, 'handle')) {
                    $instance->handle($context);
                }
            }
        }
    }
}
