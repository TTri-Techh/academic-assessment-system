<?php

namespace app\models;

use PDO;
use PDOException;

class StudentModel
{
    private $db;
    private $table = 'students';

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function register($data)
    {
        try {
            extract($data);
            $query = "INSERT INTO {$this->table}
            (enrollment_no,class_id, name_en, name_mm, username,dob,father_name,mother_name,guardian,parent_job,address,phone) 
            VALUES(:enrollment_no, :class_id, :name_en, :name_mm, :username, :dob, :father_name, :mother_name, :guardian , :parent_job, :address, :phone)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':enrollment_no', $enrollment_no);
            $stmt->bindParam(':class_id', $class_id);
            $stmt->bindParam(':name_en', $name_en);
            $stmt->bindParam(':name_mm', $name_mm);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':dob', $dob);
            $stmt->bindParam(':father_name', $father_name);
            $stmt->bindParam(':mother_name', $mother_name);
            $stmt->bindParam(':guardian', $guardian);
            $stmt->bindParam(':parent_job', $parent_job);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':phone', $phone);
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

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

    public function getAllStudents()
    {
        try {
            $query = "SELECT id, enrollment_no, name_mm, username, dob, father_name, mother_name, guardian, parent_job, address, phone FROM {$this->table} ";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public function getStudentById($id)
    {
        try {
            $query = "SELECT * FROM {$this->table} WHERE id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public function getStudentsByClassId($class_id)
    {
        try {
            $query = "SELECT * FROM {$this->table} WHERE class_id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$class_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public function updateStudentById($data)
    {
        try {
            extract($data);
            $query = "UPDATE {$this->table} SET enrollment_no = :enrollment_no, name_en = :name_en, name_mm = :name_mm, dob = :dob, father_name = :father_name, mother_name = :mother_name, guardian = :guardian, parent_job = :parent_job, address = :address, phone = :phone WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':enrollment_no', $enrollment_no);
            $stmt->bindParam(':name_en', $name_en);
            $stmt->bindParam(':name_mm', $name_mm);
            $stmt->bindParam(':dob', $dob);
            $stmt->bindParam(':father_name', $father_name);
            $stmt->bindParam(':mother_name', $mother_name);
            $stmt->bindParam(':guardian', $guardian);
            $stmt->bindParam(':parent_job', $parent_job);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':id', $id);
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public function deleteStudentById($id)
    {
        try {
            $query = "DELETE FROM {$this->table} WHERE id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
