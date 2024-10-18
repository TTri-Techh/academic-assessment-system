<?php

namespace app\models;

use PDO;
use PDOException;

class TeacherModel
{
    private $db;
    private $table = 'teachers';

    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Register a teacher 
     *
     * @param array $data [ a teacher's data ]
     *
     * @return bool
     */
    public function register($data)
    {
        try {
            $query = "INSERT INTO {$this->table} (name, username, phone) VALUES(:name, :username, :phone)";
            $stmt = $this->db->prepare($query);
            // $hashedPassword = password_hash($data['password'], PASSWORD_BCRYPT);
            $stmt->bindParam(':name', $data['name']);
            $stmt->bindParam(':username', $data['username']);
            // $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':phone', $data['phone']);

            return $stmt->execute();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Check username of teacher 
     *
     * @param string $username [teacher's username]
     *
     * @return bool|string 
     */
    public function checkUsernameExists($username)
    {
        try {
            $query = "SELECT COUNT(*) FROM {$this->table} WHERE username = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$username]);
            return $stmt->fetchColumn() > 0;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    /**
     * Find a teacher by username
     *
     * @param string $username [The username to search for]
     *
     * @return object|string [Returns a teacher object if found, or an empty string if an exception occurs]
     */
    public function findByUsername($username)
    {
        try {
            $query = "SELECT * FROM {$this->table} WHERE username = :username";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
