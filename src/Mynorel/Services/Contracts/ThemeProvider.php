<?php
namespace Mynorel\Services\Contracts;

interface ThemeProvider
{
    public static function palette(): array;
    public static function get(string $key);
}
