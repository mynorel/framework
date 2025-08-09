<?php
class TestExtensionForIntegration {
    public static $booted = false;
    public static function boot() { self::$booted = true; }
}
