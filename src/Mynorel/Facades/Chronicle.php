<?php
namespace Mynorel\Facades;

use Mynorel\Scriptorium\Scriptorium;

/**
 * Chronicle: Facade for narrative logging.
 */
class Chronicle
{
    protected static function service()
    {
        return Scriptorium::make('chronicle');
    }
    public static function note(string $message): void
    {
        self::service()::note($message);
    }
    public static function warn(string $message): void
    {
        self::service()::warn($message);
    }
    public static function chapter(string $message): void
    {
        self::service()::chapter($message);
    }
    public static function interrupt(string $message): void
    {
        self::service()::interrupt($message);
    }
}
