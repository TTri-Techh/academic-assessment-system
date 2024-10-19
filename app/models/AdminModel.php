<?php

namespace app\models;

use PDO;
use PDOException;

class AdminModel
{
    private $db;
    private $table = 'admins';

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
            $query = 'SELECT * FROM admins where email = :email';
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
