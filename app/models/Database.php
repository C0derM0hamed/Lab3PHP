<?php

class Database
{
    private static ?Database $instance = null;
    private PDO $connection;

    private function __construct(array $dbConfig)
    {
        $this->connection = new PDO(
            $dbConfig['dsn'],
            $dbConfig['username'],
            $dbConfig['password']
        );

        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance(array $dbConfig): Database
    {
        if (self::$instance === null) {
            self::$instance = new Database($dbConfig);
        }

        return self::$instance;
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }
}
