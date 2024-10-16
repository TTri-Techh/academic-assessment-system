<?php

namespace core\db;

use config\DBConfig;
use PDO;
use PDOException;

class MySQL
{
    private $db;

    public function __construct()
    {
        DBConfig::loadEnv();  // Load .env variables
        $this->db = null;
    }

    public function connect()
    {
        try {
            $dsn = DBConfig::get('DB_CONNECTION') . ":host=" . DBConfig::get('DB_HOST') .
                ";port=" . DBConfig::get('DB_PORT') .
                ";dbname=" . DBConfig::get('DB_DATABASE');

            $this->db = new PDO(
                $dsn,
                DBConfig::get('DB_USERNAME'),
                DBConfig::get('DB_PASSWORD'),
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                ]
            );

            return $this->db;
        } catch (PDOException $e) {
            // Log error and show message
            error_log("Database error: " . $e->getMessage());
            die("Database connection failed. Please try again later.");
        }
    }
}
