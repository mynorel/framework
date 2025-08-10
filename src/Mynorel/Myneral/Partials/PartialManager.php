<?php
namespace Mynorel\Myneral\Partials;

/**
 * PartialManager: Register and render template partials/macros.
 */
class PartialManager {
    protected static array $partials = [];

    public static function register($name, $content) {
        self::$partials[$name] = $content;
    }
    public static function render($name, $context = []) {
        // ...render logic (stub)...
        return self::$partials[$name] ?? '';
    }
}
