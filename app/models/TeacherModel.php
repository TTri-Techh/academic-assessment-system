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
    public function getFilteredRecords($start, $length, $search)
    {
        try {
            $query = "SELECT * FROM {$this->table} WHERE name LIKE '%{$search}%' OR username LIKE '%{$search}%' LIMIT {$length} OFFSET {$start}";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
        // $sql = "SELECT * FROM teachers 
        // WHERE name LIKE :search OR username LIKE :search 
        // LIMIT :start, :length";
        // $stmt = $this->db->prepare($sql);
        // $stmt->bindValue(':search', '%' . $search . '%');
        // $stmt->bindValue(':start', (int) $start, PDO::PARAM_INT);
        // $stmt->bindValue(':length', (int) $length, PDO::PARAM_INT);
        // $stmt->execute();
        // $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // $total = $this->getTotalTeacher();
        // // Prepare JSON response
        // $response = [
        //     "draw" => intval($_GET['draw']),
        //     "recordsTotal" => $total,
        //     "recordsFiltered" => $total, // Adjust if filtering is implemented
        //     "data" => $data
        // ];

        // echo json_encode($response);
        // return $response;
    }



    /**
     * Method getAllTeachers
     *
     * @return object
     */
    public function getAllTeachers()
    {
        try {
            $query = "SELECT * FROM {$this->table} ";
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
            $query = "SELECT id, name, username, password, phone, status FROM {$this->table} WHERE id= :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
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
            $name = $data['name'];
            $phone = $data['phone'];
            $status = $data['status'];
            $hashedPassword = $data['password'] == '123456' ? '123456' : password_hash($data['password'], PASSWORD_BCRYPT);

            $query = "UPDATE {$this->table} SET name=:name, password= :password, phone= :phone, status= :status WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':status', $status);
            return $stmt->execute();
        } catch (PDOException $e) {
            return $e->getMessage();
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
