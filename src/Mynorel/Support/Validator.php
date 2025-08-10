<?php
namespace Mynorel\Support;

use Mynorel\Console\Output\StylizedPrinter;
use Mynorel\Facades\Chronicle;

class Validator
{
    public static function require($value, string $field, ?string $context = null): bool
    {
        if (empty($value)) {
            $msg = "The field '$field' is required" . ($context ? " in $context" : '') . ".";
            StylizedPrinter::warn($msg);
            Chronicle::warn($msg);
            return false;
        }
        return true;
    }

    public static function isEmail($value, string $field, ?string $context = null): bool
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $msg = "The field '$field' must be a valid email address" . ($context ? " in $context" : '') . ".";
            StylizedPrinter::warn($msg);
            Chronicle::warn($msg);
            return false;
        }
        return true;
    }

    // Add more narrative validation methods as needed
}
