<?php
// src/Mynorel/Plotline/Database/Connection.php

namespace Mynorel\Plotline\Database;

use PDO;
use PDOException;

class Connection
{
    protected static $pdo;
    protected static $driver;

    public static function connect()
    {
        $driver = Config::get('default', 'mysql');
        $settings = Config::get('connections.' . $driver);
        self::$driver = $driver;
        try {
            switch ($driver) {
                case 'mysql':
                    $dsn = "mysql:host={$settings['host']};port={$settings['port']};dbname={$settings['database']};charset={$settings['charset']}";
                    self::$pdo = new PDO($dsn, $settings['username'], $settings['password']);
                    break;
                case 'pgsql':
                    $dsn = "pgsql:host={$settings['host']};port={$settings['port']};dbname={$settings['database']};";
                    self::$pdo = new PDO($dsn, $settings['username'], $settings['password']);
                    break;
                case 'sqlite':
                    $dsn = "sqlite:{$settings['database']}";
                    self::$pdo = new PDO($dsn);
                    break;
                case 'sqlsrv':
                    $dsn = "sqlsrv:Server={$settings['host']},{$settings['port']};Database={$settings['database']}";
                    self::$pdo = new PDO($dsn, $settings['username'], $settings['password']);
                    break;
                default:
                    throw new PDOException("Unsupported driver: $driver");
            }
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new \RuntimeException('Database connection failed: ' . $e->getMessage());
        }
        return self::$pdo;
    }

    public static function pdo()
    {
        if (!self::$pdo) {
            self::connect();
        }
        return self::$pdo;
    }

    public static function driver()
    {
        if (!self::$driver) {
            self::connect();
        }
        return self::$driver;
    }
}
