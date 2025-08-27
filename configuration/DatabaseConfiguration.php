<?php

class DatabaseConfiguration {
    function getDBConnection()
    {
        $host = 'localhost';
        $port = '3306';
        $dbname = 'parking';
        $username = 'root';
        $password = 'admin';

        try {
            $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
            return new \PDO($dsn, $username, $password, [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_EMULATE_PREPARES => false
            ]);
        } catch (\PDOException $e) {
            throw new \Exception("Connection error: " . $e->getMessage());
        }
    }
}
?>