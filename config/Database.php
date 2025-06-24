<?php
class Database
{
    private static $conn;

    public static function getConnection()
    {
        if (!self::$conn) {
            try {
                $host = 'localhost';
                $dbname = 'miniatur_bus';
                $username = 'root';
                $password = '';

                self::$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Koneksi database gagal: " . $e->getMessage());
            }
        }
        return self::$conn;
    }
}
?>