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
            $this->db->beginTransaction();

            extract($data);
            $query = "INSERT INTO $this->table (subject_id, chapter_no, chapter_name, title, description, teacher_id, class_id) 
                    VALUES (:subject_id, :chapter_no, :chapter_name, :title, :description, :teacher_id, :class_id)";

            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':subject_id', $subject_id);
            $stmt->bindParam(':chapter_no', $chapter_no);
            $stmt->bindParam(':chapter_name', $chapter_name);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':teacher_id', $teacher_id);
            $stmt->bindParam(':class_id', $class_id);
            $stmt->execute();

            // Get the last inserted resource id
            $resource_id = $this->db->lastInsertId();

            // Insert files
            foreach ($filesArr as $file) {
                $query = "INSERT INTO files (resource_id, file_path) VALUES (:resource_id, :file_path)";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(':resource_id', $resource_id);
                $stmt->bindParam(':file_path', $file);
                $stmt->execute();
            }

            $this->db->commit();
            return true;
        } catch (PDOException $e) {
            $this->db->rollBack();
            echo $e->getMessage();
            return false;
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

    public function getResourceById($id)
    {
        try {
            $query = "SELECT * FROM $this->table WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function updateResource($data, $id)
    {
        try {
            extract($data);
            $query = "UPDATE $this->table SET 
                    chapter_no = :chapter_no,
                    chapter_name = :chapter_name,
                    title = :title,
                    description = :description
                    WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':chapter_no', $chapter_no);
            $stmt->bindParam(':chapter_name', $chapter_name);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function deleteResource($id)
    {
        try {
            $this->db->beginTransaction();

            // Get file paths before deletion
            $files = $this->getResourceFiles($id);

            // Delete files from storage
            foreach ($files as $file) {
                $filePath = '../' . $file['file_path'];
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }

            // Delete from files table
            $query = "DELETE FROM files WHERE resource_id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            // Delete from resources table
            $query = "DELETE FROM $this->table WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $this->db->commit();
            return true;
        } catch (PDOException $e) {
            $this->db->rollBack();
            echo $e->getMessage();
            return false;
        }
    }

    public function getResourceFiles($resource_id)
    {
        try {
            $query = "SELECT * FROM files WHERE resource_id = :resource_id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':resource_id', $resource_id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getResourcesByTeacher($teacher_id)
    {
        try {
            $query = "SELECT r.*, GROUP_CONCAT(f.file_path SEPARATOR ',') as files 
                     FROM $this->table r 
                     LEFT JOIN files f ON r.id = f.resource_id 
                     WHERE r.teacher_id = :teacher_id 
                     GROUP BY r.id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':teacher_id', $teacher_id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return [];
        }
    }

    public function deleteFile($file_id)
    {
        try {
            // Get file path before deletion
            $query = "SELECT file_path FROM files WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $file_id);
            $stmt->execute();
            $file = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($file) {
                // Delete physical file
                $filePath = '../' . $file['file_path'];
                if (file_exists($filePath)) {
                    unlink($filePath);
                }

                // Delete from database
                $query = "DELETE FROM files WHERE id = :id";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(':id', $file_id);
                return $stmt->execute();
            }
            return false;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function addNewFiles($resource_id, $filesArr)
    {
        try {
            $this->db->beginTransaction();

            foreach ($filesArr as $file) {
                $query = "INSERT INTO files (resource_id, file_path) VALUES (:resource_id, :file_path)";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(':resource_id', $resource_id);
                $stmt->bindParam(':file_path', $file);
                $stmt->execute();
            }

            $this->db->commit();
            return true;
        } catch (PDOException $e) {
            $this->db->rollBack();
            echo $e->getMessage();
            return false;
        }
    }

    public function getResourcesByClassId($classId)
    {
        try {
            $query = "SELECT r.*, s.subject_name as subject_name, 
                            GROUP_CONCAT(f.file_path SEPARATOR ',') as files 
                     FROM resources r
                     LEFT JOIN subjects s ON r.subject_id = s.id
                     LEFT JOIN files f ON r.id = f.resource_id
                     WHERE r.class_id = :class_id
                     GROUP BY r.id, r.subject_id, r.chapter_no, r.chapter_name, 
                              r.title, r.description, s.subject_name
                     ORDER BY s.subject_name, r.chapter_no";

            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':class_id', $classId, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return [];
        }
    }
}
