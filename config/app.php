<?php
// config/app.php


use Mynorel\Config\Config;

return [
    'name' => 'Mynorel',
    'env' => Config::get('app.env', getenv('APP_ENV') ?: 'production'),
    'debug' => Config::get('app.debug', getenv('APP_DEBUG') === 'true'),
    'url' => Config::get('app.url', getenv('APP_URL') ?: 'http://localhost'),
];
