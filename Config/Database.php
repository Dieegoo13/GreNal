<?php

namespace Config;

use PDO;
use PDOException;

class Database
{
    private static $conn = null;
    private static $host = "localhost";
    private static $db_name = "grenal";
    private static $username = "root";
    private static $password = "";

    public static function getConnection()
    {
        if (!self::$conn) {
            try {
                self::$conn = new PDO(
                    "mysql:host=" . self::$host . ";dbname=" . self::$db_name,
                    self::$username,
                    self::$password
                );
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Erro de conexão: " . $e->getMessage());
            }
        }

        return self::$conn;
    }
}

