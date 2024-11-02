<?php

namespace app\models;

use PDO;
use PDOException;

class ChapterlyAssessmentModel
{
    private $db;
    private $table = 'chapterly_assessment';
    private $chapter_table = 'chapters';
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function createChapterlyAssessment($assessmentDataArray)
    {
        try {
            // Create monthly chapter once
            $firstData = $assessmentDataArray[0]; // Get first item for chapter creation
            $chapter_id = $this->createChapter($firstData);

            // Create assessment for each student
            foreach ($assessmentDataArray as $data) {
                $query = "INSERT INTO {$this->table} 
                        (student_id, teacher_id, subject_id, class_id, chapter_id, chapter_no, year) 
                        VALUES 
                        (:student_id, :teacher_id, :subject_id, :class_id, :chapter_id, :chapter_no, :year)";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(':student_id', $data['student_id']);
                $stmt->bindParam(':teacher_id', $data['teacher_id']);
                $stmt->bindParam(':subject_id', $data['subject_id']);
                $stmt->bindParam(':class_id', $data['class_id']);
                $stmt->bindParam(':chapter_id', $chapter_id);
                $stmt->bindParam(':chapter_no', $data['chapter_no']);
                $stmt->bindParam(':year', $data['year']);
                $stmt->execute();
            }
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    public function createChapter($data)
    {
        try {
            extract($data);
            $query = "INSERT INTO {$this->chapter_table} (subject_id, class_id, chapter_no) VALUES (:subject_id, :class_id, :chapter_no)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':subject_id', $subject_id);
            $stmt->bindParam(':class_id', $class_id);
            $stmt->bindParam(':chapter_no', $chapter_no);
            $stmt->execute();
            // return the last inserted id
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function checkAssessmentIsCreated($data)
    {
        try {
            extract($data);
            $query = "SELECT * FROM {$this->table} WHERE subject_id = :subject_id AND class_id = :class_id AND chapter_no = :chapter_no AND year = :year";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':subject_id', $subject_id);
            $stmt->bindParam(':class_id', $class_id);
            $stmt->bindParam(':chapter_no', $chapter_no);
            $stmt->bindParam(':year', $year);
            $stmt->execute();
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getAllChapterlyAssessment($data)
    {
        try {
            extract($data);
            $query = "SELECT {$this->table}.*, students.name_mm as student_name 
                    FROM {$this->table}
                    JOIN students ON {$this->table}.student_id = students.id
                    WHERE {$this->table}.subject_id = :subject_id 
                    AND {$this->table}.class_id = :class_id 
                    AND {$this->table}.chapter_no = :chapter_no 
                    AND {$this->table}.year = :year";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':subject_id', $subject_id);
            $stmt->bindParam(':class_id', $class_id);
            $stmt->bindParam(':chapter_no', $chapter_no);
            $stmt->bindParam(':year', $year);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    public function updateChapterlyAssessment($data)
    {
        try {
            extract($data);
            $query = "UPDATE {$this->table} SET mark = :mark, remark = :remark WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':mark', $mark);
            $stmt->bindParam(':remark', $remark);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getChapter($data)
    {
        try {
            $query = "SELECT mc.* 
                    FROM {$this->chapter_table} mc
                    JOIN {$this->table} ma ON mc.id = ma.chapter_id
                    WHERE mc.subject_id = :subject_id 
                    AND mc.class_id = :class_id 
                    AND mc.chapter_no = :chapter_no 
                    AND mc.year = :year
                    LIMIT 1";

            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':subject_id', $data['subject_id']);
            $stmt->bindParam(':class_id', $data['class_id']);
            $stmt->bindParam(':chapter_no', $data['chapter_no']);
            $stmt->bindParam(':year', $data['year']);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function updateChapterByConditions($data)
    {
        try {
            $sql = "UPDATE {$this->chapter_table} 
                    SET chapter = :chapter,
                        learning_outcomes = :learning_outcomes,
                        check_points = :check_points,
                        updated_at = NOW()
                    WHERE subject_id = :subject_id 
                    AND class_id = :class_id 
                    AND chapter_no = :chapter_no 
                    AND year = :year";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':chapter', $data['chapter']);
            $stmt->bindParam(':learning_outcomes', $data['learning_outcomes']);
            $stmt->bindParam(':check_points', $data['check_points']);
            $stmt->bindParam(':subject_id', $data['subject_id']);
            $stmt->bindParam(':class_id', $data['class_id']);
            $stmt->bindParam(':chapter_no', $data['chapter_no']);
            $stmt->bindParam(':year', $data['year']);
            return $stmt->execute();
        } catch (PDOException $e) {
            // Handle error appropriately
            return false;
        }
    }

    public function deleteChapterlyAssessment($data)
    {
        try {
            extract($data);
            $query = "DELETE FROM {$this->table} WHERE subject_id = :subject_id AND chapter_no = :chapter_no AND class_id = :class_id AND year = :year";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':subject_id', $subject_id);
            $stmt->bindParam(':chapter_no', $chapter_no);
            $stmt->bindParam(':class_id', $class_id);
            $stmt->bindParam(':year', $year);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function deleteAllChapterlyAssessment($data)
    {
        try {
            extract($data);
            $query = "DELETE FROM {$this->table} WHERE class_id = :class_id AND year = :year";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':class_id', $class_id);
            $stmt->bindParam(':year', $year);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
