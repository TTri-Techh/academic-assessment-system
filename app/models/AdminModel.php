<?php

namespace app\models;

use PDO;
use PDOException;

class AdminModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }
    /**
     * Method findByEmail
     *
     * @param string $email [Admin's email]
     *
     * @return object
     */
    public function findByEmail($email)
    {
        try {
            $query = 'SELECT * from admins where email = :email';
            $stmt = $this->db->prepare($query);
            $stmt->execute([
                'email' => $email,
            ]);
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
