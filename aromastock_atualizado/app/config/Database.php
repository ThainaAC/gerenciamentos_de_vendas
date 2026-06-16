<?php

class Database {
    private static $host = "localhost";
    private static $dbname = "aromastock";
    private static $user = "root";
    private static $pass = "";
    private static $conn = null;

    public static function conectar() {
        if (self::$conn === null) {
            try {
                self::$conn = new PDO(
                    "mysql:host=" . self::$host . ";dbname=" . self::$dbname . ";charset=utf8",
                    self::$user,
                    self::$pass
                );
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Erro ao conectar com o banco: " . $e->getMessage());
            }
        }
        return self::$conn;
    }
}
