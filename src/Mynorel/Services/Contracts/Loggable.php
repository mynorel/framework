<?php
namespace Mynorel\Services\Contracts;

interface Loggable
{
    public static function note(string $message): void;
    public static function warn(string $message): void;
    public static function chapter(string $message): void;
}
