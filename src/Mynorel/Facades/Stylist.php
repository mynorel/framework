<?php
namespace Mynorel\Facades;

use Mynorel\Stylist\StylistService;

/**
 * Stylist: Facade for CSS compilation and theming.
 */
class Stylist
{
    public static function compile($type, $input, $output, $options = [])
    {
        return StylistService::compile($type, $input, $output, $options);
    }
}
