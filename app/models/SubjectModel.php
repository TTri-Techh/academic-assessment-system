<?php

namespace app\models;

use PDO;
use PDOException;

class SubjectModel
{
    private $db;
    private $table = 'subjects';

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getSubjectNameById($subject_id)
    {
        try {
            $query = "SELECT subject_name FROM $this->table WHERE id = :subject_id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":subject_id", $subject_id);
            $stmt->execute();
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function getMainSubjects()
    {
        try {
            $query = "SELECT * FROM $this->table LIMIT 5";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
