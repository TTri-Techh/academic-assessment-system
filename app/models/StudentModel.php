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
            $query = "INSERT INTO {$this->table}
            (enrollment_no, name_en, name_my, username,dob,father_name,mother_name,guardian,parent_job,address,phone_number) 
            VALUES(:enrollment_no, :name_en, :name_my, :username, :dob, :father_name, :mother_name, :guardian , :parent_job, :address, :phone_number)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':enrollment_no', $data['enrollment_no']);
            $stmt->bindParam(':name_en', $data['name_en']);
            $stmt->bindParam(':name_my', $data['name_my']);
            $stmt->bindParam(':username', $data['username']);
            $stmt->bindParam(':dob', $data['dob']);
            $stmt->bindParam(':father_name', $data['father_name']);
            $stmt->bindParam(':mother_name', $data['mother_name']);
            $stmt->bindParam(':guardian', $data['guardian']);
            $stmt->bindParam(':parent_job', $data['parent_job']);
            $stmt->bindParam(':address', $data['address']);
            $stmt->bindParam(':phone_number', $data['phone_number']);
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
            $query = "SELECT id,enrollment_no,name_my,dob,father_name,mother_name,guardian,parent_job,address,phone_number FROM {$this->table} ";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}