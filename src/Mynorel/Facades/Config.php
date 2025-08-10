<?php
namespace Mynorel\Facades;

use Mynorel\Config\Config as BaseConfig;

class Config
{
    /**
     * Get a configuration value using dot notation.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function get(string $key, $default = null)
    {
        return BaseConfig::get($key, $default);
    }
}
