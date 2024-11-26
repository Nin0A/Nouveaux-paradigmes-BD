<?php

namespace iutnc\hellokant\connection;

use PDO;

class ConnectionFactory
{

    private static PDO $pdo;

    public static function makeConnection(array $conf): \PDO
    {
        if (!isset(self::$pdo)) {
            $driver = $conf['driver'];
            $host = $conf['host'];
            $database = $conf['database'];
            $username = $conf['username'];
            $password = $conf['password'];

            $dsn = "$driver:host=$host;dbname=$database";

            static::$pdo = new PDO($dsn, $username, $password, [
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::ATTR_STRINGIFY_FETCHES => false
            ]);
        }
        return self::$pdo;
    }

    public static function getConnection(): \PDO
    {
        return (isset(static::$pdo) ? static::$pdo : null);
    }
}
