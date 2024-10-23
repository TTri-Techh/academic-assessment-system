<?php

namespace app\models;

use PDO;
use PDOException;

class ClassModel
{
    private $db;
    private $table = 'classes';

    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Method getAllClasses
     *
     * @return object
     */
    public function getAllClasses()
    {
        try {

            $query = "SELECT * FROM $this->table";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
