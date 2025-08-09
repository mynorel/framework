<?php
namespace Mynorel\Facades;

use Mynorel\Chronicle\Chronicle as ChronicleCore;

/**
 * Chronicle: Facade for narrative logging.
 */
class Chronicle
{
    public static function note(string $message): void
    {
        ChronicleCore::note($message);
    }
    public static function warn(string $message): void
    {
        ChronicleCore::warn($message);
    }
    public static function chapter(string $message): void
    {
        ChronicleCore::chapter($message);
    }
    public static function interrupt(string $message): void
    {
        ChronicleCore::interrupt($message);
    }
}
