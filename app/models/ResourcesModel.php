<?php

namespace app\models;

use PDO;
use PDOException;

class ResourcesModel
{
    private $db;
    private $table = 'resources';

    public function __construct($db)
    {
        $this->db = $db;
    }
    public function createResource($data, $filesArr)
    {
        try {
            extract($data);
            $query = "INSERT INTO $this->table (chapter_no,chapter_name,title,description,teacher_id,class_id) VALUES (:chapter_no,:chapter_name,:title,:description,:teacher_id,:class_id  )";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':chapter_no', $chapter_no);
            $stmt->bindParam(':chapter_name', $chapter_name);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':teacher_id', $teacher_id);
            $stmt->bindParam(':class_id', $class_id);
            // insert files into files table
            $this->insertFiles($filesArr, $this->db->lastInsertId());
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function insertFiles($filesArr, $resource_id)
    {
        try {
            foreach ($filesArr as $file) {
                $query = "INSERT INTO files (resource_id,file_path) VALUES (:resource_id,:file_path)";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(':resource_id', $resource_id);
                $stmt->bindParam(':file_path', $file);
                $stmt->execute();
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getAllResources($class_id, $chapter_no)
    {
        try {
            $query = "SELECT * FROM $this->table WHERE class_id = :class_id AND chapter_no = :chapter_no";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':class_id', $class_id);
            $stmt->bindParam(':chapter_no', $chapter_no);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
