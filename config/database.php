<?php
// config/database.php


use Mynorel\Config\Config;

return [
    // The default database connection name
    'default' => Config::get('database.default', getenv('DB_CONNECTION') ?: 'mysql'),

    // Database connections
    'connections' => [
        'mysql' => [
            'driver' => 'mysql',
            'host' => Config::get('database.connections.mysql.host', getenv('DB_HOST') ?: '127.0.0.1'),
            'port' => Config::get('database.connections.mysql.port', getenv('DB_PORT') ?: '3306'),
            'database' => Config::get('database.connections.mysql.database', getenv('DB_DATABASE') ?: 'mynorel'),
            'username' => Config::get('database.connections.mysql.username', getenv('DB_USERNAME') ?: 'root'),
            'password' => Config::get('database.connections.mysql.password', getenv('DB_PASSWORD') ?: ''),
            'charset' => 'utf8mb4',
            'strict' => true,
            'options' => [],
            'pool' => false, // Set to true to enable connection pooling if supported
        ],
        'pgsql' => [
            'driver' => 'pgsql',
            'host' => Config::get('database.connections.pgsql.host', getenv('DB_HOST') ?: '127.0.0.1'),
            'port' => Config::get('database.connections.pgsql.port', getenv('DB_PORT') ?: '5432'),
            'database' => Config::get('database.connections.pgsql.database', getenv('DB_DATABASE') ?: 'mynorel'),
            'username' => Config::get('database.connections.pgsql.username', getenv('DB_USERNAME') ?: 'postgres'),
            'password' => Config::get('database.connections.pgsql.password', getenv('DB_PASSWORD') ?: ''),
            'charset' => 'utf8',
            'strict' => true,
            'options' => [],
            'pool' => false,
        ],
        'sqlite' => [
            'driver' => 'sqlite',
            'database' => Config::get('database.connections.sqlite.database', getenv('DB_DATABASE') ?: (__DIR__.'/../database/database.sqlite')),
            'pool' => false,
        ],
        'sqlsrv' => [
            'driver' => 'sqlsrv',
            'host' => Config::get('database.connections.sqlsrv.host', getenv('DB_HOST') ?: 'localhost'),
            'port' => Config::get('database.connections.sqlsrv.port', getenv('DB_PORT') ?: '1433'),
            'database' => Config::get('database.connections.sqlsrv.database', getenv('DB_DATABASE') ?: 'mynorel'),
            'username' => Config::get('database.connections.sqlsrv.username', getenv('DB_USERNAME') ?: 'sa'),
            'password' => Config::get('database.connections.sqlsrv.password', getenv('DB_PASSWORD') ?: ''),
            'charset' => 'utf8',
            'pool' => false,
        ],
        // Add more drivers as needed
    ],

    // Global database options
    'fetch' => PDO::FETCH_ASSOC,
    'migrations' => 'migrations', // Table for tracking migrations
];
