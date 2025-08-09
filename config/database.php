<?php
// config/database.php

return [
    // The default database connection name
    'default' => getenv('DB_CONNECTION') ?: 'mysql',

    // Database connections
    'connections' => [
        'mysql' => [
            'driver' => 'mysql',
            'host' => getenv('DB_HOST') ?: '127.0.0.1',
            'port' => getenv('DB_PORT') ?: '3306',
            'database' => getenv('DB_DATABASE') ?: 'mynorel',
            'username' => getenv('DB_USERNAME') ?: 'root',
            'password' => getenv('DB_PASSWORD') ?: '',
            'charset' => 'utf8mb4',
            'strict' => true,
            'options' => [],
            'pool' => false, // Set to true to enable connection pooling if supported
        ],
        'pgsql' => [
            'driver' => 'pgsql',
            'host' => getenv('DB_HOST') ?: '127.0.0.1',
            'port' => getenv('DB_PORT') ?: '5432',
            'database' => getenv('DB_DATABASE') ?: 'mynorel',
            'username' => getenv('DB_USERNAME') ?: 'postgres',
            'password' => getenv('DB_PASSWORD') ?: '',
            'charset' => 'utf8',
            'strict' => true,
            'options' => [],
            'pool' => false,
        ],
        'sqlite' => [
            'driver' => 'sqlite',
            'database' => getenv('DB_DATABASE') ?: (__DIR__.'/../database/database.sqlite'),
            'pool' => false,
        ],
        'sqlsrv' => [
            'driver' => 'sqlsrv',
            'host' => getenv('DB_HOST') ?: 'localhost',
            'port' => getenv('DB_PORT') ?: '1433',
            'database' => getenv('DB_DATABASE') ?: 'mynorel',
            'username' => getenv('DB_USERNAME') ?: 'sa',
            'password' => getenv('DB_PASSWORD') ?: '',
            'charset' => 'utf8',
            'pool' => false,
        ],
        // Add more drivers as needed
    ],

    // Global database options
    'fetch' => PDO::FETCH_ASSOC,
    'migrations' => 'migrations', // Table for tracking migrations
];
