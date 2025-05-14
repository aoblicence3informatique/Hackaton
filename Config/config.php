<?php

class Config {
    private static $settings = array(
        'database' => array(
            'host' => 'localhost',
            'dbname' => 'plateforme_signalement',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8mb4'
        )
    );

    public static function get($key) {
        return isset(self::$settings[$key]) ? self::$settings[$key] : null;
    }
}

class Database {
    private static $connection = null;

    public static function getConnection() {
        if (self::$connection === null) {
            try {
                $dbConfig = Config::get('database');

                self::$connection = new PDO(
                    "mysql:host=" . $dbConfig['host'] . ";dbname=" . $dbConfig['dbname'] . ";charset=" . $dbConfig['charset'],
                    $dbConfig['username'],
                    $dbConfig['password']
                );

                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Erreur de connexion : " . $e->getMessage());
            }
        }

        return self::$connection;
    }
}
?>