<?php
// src/Mynorel/Plotline/Database/Config.php

namespace Mynorel\Plotline\Database;

class Config
{
    public static function get($key, $default = null)
    {
        $config = require __DIR__ . '/../../../../config/database.php';
        $keys = explode('.', $key);
        $value = $config;
        foreach ($keys as $k) {
            if (is_array($value) && array_key_exists($k, $value)) {
                $value = $value[$k];
            } else {
                return $default;
            }
        }
        return $value;
    }
}
