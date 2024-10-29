<?php

namespace app\models;

use PDO;
use PDOException;

class QcprModel
{
    private $db;
    private $table = 'qcpr';
    private $monthly_test = 'monthly_test'; // G4, G5
    private $monthly_assessment = 'monthly_assessment'; // G1, G2, G3

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function createAnnouncement($class_id, $teacher_id)
    {
        try {
            if ($this->announcementIsExist($class_id, $teacher_id)) {
                return;
            }
            $query = "INSERT INTO $this->table (class_id, teacher_id) VALUES (:class_id, :teacher_id)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':class_id', $class_id);
            $stmt->bindParam(':teacher_id', $teacher_id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
    public function announcementIsExist($class_id, $teacher_id)
    {
        $query = "SELECT * FROM $this->table WHERE class_id = :class_id AND teacher_id = :teacher_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':class_id', $class_id);
        $stmt->bindParam(':teacher_id', $teacher_id);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }
    public function getAnnouncementStatus($class_id)
    {
        try {
            $query = "SELECT status FROM $this->table WHERE class_id = :class_id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':class_id', $class_id);
            $stmt->execute();
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function updateAnnouncement($class_id, $teacher_id, $status)
    {
        try {
            $query = "UPDATE $this->table SET status = :status, updated_at = NOW() WHERE class_id = :class_id AND teacher_id = :teacher_id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':class_id', $class_id);
            $stmt->bindParam(':teacher_id', $teacher_id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    // get a student qcpr data for G4, G5
    public function getUpperQcpr($data)
    {
        try {
            extract($data);
            $query = "SELECT * FROM $this->monthly_test WHERE class_id = :class_id AND student_id = :student_id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':class_id', $class_id);
            $stmt->bindParam(':student_id', $student_id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }

    // get a student qcpr data for G1, G2, G3
    public function getLowerQcpr($data)
    {
        try {
            extract($data);
            $query = "SELECT * FROM $this->monthly_assessment WHERE class_id = :class_id AND student_id = :student_id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':class_id', $class_id);
            $stmt->bindParam(':student_id', $student_id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }
}
