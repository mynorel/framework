<?php
// src/Mynorel/Plotline/Database/Config.php

namespace Mynorel\Plotline\Database;

class Config
{
    public static function get($key, $default = null)
    {
        // Use the Config Facade for all config access
        return \Mynorel\Facades\Config::get('database.' . $key, $default);
    }
}
