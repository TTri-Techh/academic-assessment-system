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
            $query = "INSERT INTO {$this->table}
                (name_eng, name_mm, username, father_name, mother_name,education, rank, dob ,start_edu_at ,start_current_rank_at ,start_current_school_at ,phone, address, bed_status, phaung_gyi_status, completed_course) 
                VALUES(:name_eng, :name_mm, :username, :father_name, :mother_name,:education, :rank, :dob, :start_edu_at, :start_current_rank_at, :start_current_school_at , :phone, :address, :bed_status, :phaung_gyi_status, :completed_course)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':name_eng', $data['name_eng']);
            $stmt->bindParam(':name_mm', $data['name_mm']);
            $stmt->bindParam(':username', $data['username']);
            $stmt->bindParam(':father_name', $data['father_name']);
            $stmt->bindParam(':mother_name', $data['mother_name']);
            $stmt->bindParam(':education', $data['education']);
            $stmt->bindParam(':rank', $data['rank']);
            $stmt->bindParam(':dob', $data['dob']);
            $stmt->bindParam(':start_edu_at', $data['start_edu_at']);
            $stmt->bindParam(':start_current_rank_at', $data['start_current_rank_at']);
            $stmt->bindParam(':start_current_school_at', $data['start_current_school_at']);
            $stmt->bindParam(':phone', $data['phone']);
            $stmt->bindParam(':address', $data['address']);
            $stmt->bindParam(':bed_status', $data['bed_status']);
            $stmt->bindParam(':phaung_gyi_status', $data['phaung_gyi_status']);
            $stmt->bindParam(':completed_course', $data['completed_course']);
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
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

    /**
     * Method to get the number of total teacher 
     *
     * @return int
     */
    public function getTotalTeacher()
    {
        try {
            $query = "SELECT COUNT(*) FROM {$this->table} ";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    // public function getTeachersByPage($page, $limit){
    //     try {
    //         $offset = ($page - 1) * $limit;
    //         $query = "SELECT * FROM {$this->table} LIMIT $limit OFFSET $offset";
    //         $stmt = $this->db->prepare($query);
    //         $stmt->execute();
    //         return $stmt->fetchAll(PDO::FETCH_ASSOC);
    //     } catch (PDOException $e) {
    //         return $e->getMessage();
    //     }
    // }
    // Fetch filtered/paginated records
    // public function getFilteredRecords($start, $length, $search)
    // {
    //     try {
    //         $query = "SELECT * FROM {$this->table} WHERE name LIKE '%{$search}%' OR username LIKE '%{$search}%' LIMIT {$length} OFFSET {$start}";
    //         $stmt = $this->db->prepare($query);
    //         $stmt->execute();
    //         return $stmt->fetchAll(PDO::FETCH_ASSOC);
    //     } catch (PDOException $e) {
    //         return $e->getMessage();
    //     }
    // }



    /**
     * Method getAllTeachers
     *
     * @return object
     */
    public function getAllTeachers()
    {
        try {
            $query = "SELECT id,name_mm, username, password, father_name, mother_name, rank, education, dob, start_edu_at,bed_status, start_current_rank_at, start_current_school_at, phaung_gyi_status, completed_course, status, phone, address  FROM {$this->table} ";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    /**
     * Method to get a teacher by id
     *
     * @return object
     */
    public function getTeacherById($id)
    {
        try {
            $query = "SELECT * FROM {$this->table} WHERE id= :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    /**
     * Method to get teachers' id and name
     *
     * @return object
     */
    public function getAllTeachersClass()
    {
        try {
            $query = "SELECT id, name_mm, class_id
                FROM {$this->table}
                ";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    /**
     * Method to get a teacher class data by id
     *
     * @return object
     */
    public function getTeacherClassNameById($id)
    {
        try {
            $query = "SELECT name_mm, class_id, classes.class_name_mm as class_name 
                FROM {$this->table}
                LEFT JOIN classes ON teachers.class_id = classes.id
                WHERE teachers.id= :id
                ";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    /**
     * Method to get a teacher's class
     *
     * @return object
     */
    public function getATeacherClassName($id)
    {
        try {
            $query = "SELECT class_id FROM {$this->table}";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    /**
     * Method update (assign) teacher class
     *
     * @param int $id [teacher id]
     * 
     * @param int $classId [teacher's class id]
     *
     * @return bool|string
     */
    public function updateTeacherClassById($id, $classId)
    {
        try {
            $query = "UPDATE {$this->table} SET class_id= :classId WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':classId', $classId);
            return $stmt->execute();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Method updateTeacherById
     *
     * @param array $data [TeacherData]
     *
     * @return bool|string
     */
    public function updateTeacherById($data)
    {
        try {
            $id = $data['id'];
            $hashedPassword = ($data['password'] === '123456')
                ? '123456'
                : password_hash($data['password'], PASSWORD_BCRYPT);

            $query = "UPDATE {$this->table} SET 
                name_eng = :name_eng, 
                name_mm = :name_mm, 
                father_name = :father_name, 
                mother_name = :mother_name, 
                rank = :rank, 
                education = :education, 
                dob = :dob, 
                completed_course = :completed_course, 
                address = :address, 
                bed_status = :bed_status, 
                phaung_gyi_status = :phaung_gyi_status, 
                start_edu_at = :start_edu_at, 
                start_current_rank_at = :start_current_rank_at, 
                start_current_school_at = :start_current_school_at, 
                password = :password, 
                phone = :phone, 
                status = :status 
                WHERE id = :id";

            $stmt = $this->db->prepare($query);

            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':name_eng', $data['name_eng']);
            $stmt->bindParam(':name_mm', $data['name_mm']);
            $stmt->bindParam(':father_name', $data['father_name']);
            $stmt->bindParam(':mother_name', $data['mother_name']);
            $stmt->bindParam(':rank', $data['rank']);
            $stmt->bindParam(':education', $data['education']);
            $stmt->bindParam(':dob', $data['dob']);
            $stmt->bindParam(':completed_course', $data['completed_course']);
            $stmt->bindParam(':address', $data['address']);
            $stmt->bindParam(':bed_status', $data['bed_status']);
            $stmt->bindParam(':phaung_gyi_status', $data['phaung_gyi_status']);
            $stmt->bindParam(':start_edu_at', $data['start_edu_at']);
            $stmt->bindParam(':start_current_rank_at', $data['start_current_rank_at']);
            $stmt->bindParam(':start_current_school_at', $data['start_current_school_at']);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':phone', $data['phone']);
            $stmt->bindParam(':status', $data['status']);

            return $stmt->execute();
            if (!$stmt->execute()) {
                error_log("Query failed: " . implode(" - ", $stmt->errorInfo()));
                return false;
            }
        } catch (PDOException $e) {
            // Log the error for debugging
            error_log("Update Teacher Error: " . $e->getMessage());
            return $e->getMessage();  // Return error message to caller
        }
    }


    /**
     * Method deleteTeacherById
     *
     * @param $id $id [teacher's id to be deleted]
     *
     * @return void
     */
    public function deleteTeacherById($id)
    {
        try {
            $query = "DELETE FROM {$this->table} WHERE id= :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
