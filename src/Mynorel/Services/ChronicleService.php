<?php
namespace Mynorel\Services;

class ChronicleService
{
    protected static array $log = [];

    public static function note(string $message): void
    {
        self::$log[] = ['level' => 'info', 'message' => $message];
    }

    public static function warn(string $message): void
    {
        self::$log[] = ['level' => 'warning', 'message' => $message];
    }

    public static function chapter(string $message): void
    {
        self::$log[] = ['level' => 'chapter', 'message' => $message];
    }

    public static function all(): array
    {
        return self::$log;
    }
}
