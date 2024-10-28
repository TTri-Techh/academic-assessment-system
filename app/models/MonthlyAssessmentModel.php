<?php

namespace app\models;

use PDO;
use PDOException;

class MonthlyAssessmentModel
{
    private $db;
    private $table = 'monthly_assessment';
    private $monthly_chapter_table = 'monthly_chapters';
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function createMonthlyAssessment($assessmentDataArray)
    {
        try {
            // Create monthly chapter once
            $firstData = $assessmentDataArray[0]; // Get first item for chapter creation
            $monthly_chapter_id = $this->createMonthlyChapter($firstData);

            // Create assessment for each student
            foreach ($assessmentDataArray as $data) {
                $query = "INSERT INTO {$this->table} 
                        (student_id, teacher_id, subject_id, class_id, monthly_chapter_id, month_no, year) 
                        VALUES 
                        (:student_id, :teacher_id, :subject_id, :class_id, :monthly_chapter_id, :month_no, :year)";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(':student_id', $data['student_id']);
                $stmt->bindParam(':teacher_id', $data['teacher_id']);
                $stmt->bindParam(':subject_id', $data['subject_id']);
                $stmt->bindParam(':class_id', $data['class_id']);
                $stmt->bindParam(':monthly_chapter_id', $monthly_chapter_id);
                $stmt->bindParam(':month_no', $data['month_no']);
                $stmt->bindParam(':year', $data['year']);
                $stmt->execute();
            }
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    public function createMonthlyChapter($data)
    {
        try {
            extract($data);
            $query = "INSERT INTO {$this->monthly_chapter_table} (subject_id, class_id, month_no) VALUES (:subject_id, :class_id, :month_no)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':subject_id', $subject_id);
            $stmt->bindParam(':class_id', $class_id);
            $stmt->bindParam(':month_no', $month_no);
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
            $query = "SELECT * FROM {$this->table} WHERE subject_id = :subject_id AND class_id = :class_id AND month_no = :month_no AND year = :year";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':subject_id', $subject_id);
            $stmt->bindParam(':class_id', $class_id);
            $stmt->bindParam(':month_no', $month_no);
            $stmt->bindParam(':year', $year);
            $stmt->execute();
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getAllMonthlyAssessment($data)
    {
        try {
            extract($data);
            $query = "SELECT {$this->table}.*, students.name_mm as student_name 
                    FROM {$this->table}
                    JOIN students ON {$this->table}.student_id = students.id
                    WHERE {$this->table}.subject_id = :subject_id 
                    AND {$this->table}.class_id = :class_id 
                    AND {$this->table}.month_no = :month_no 
                    AND {$this->table}.year = :year";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':subject_id', $subject_id);
            $stmt->bindParam(':class_id', $class_id);
            $stmt->bindParam(':month_no', $month_no);
            $stmt->bindParam(':year', $year);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    // public function getMonthlyAssessmentByStudentId($student_id)
    // {
    //     try {
    //         $query = "SELECT * FROM {$this->table} WHERE student_id = :student_id";
    //         $stmt = $this->db->prepare($query);
    //         $stmt->bindParam(':student_id', $student_id);
    //         $stmt->execute();
    //         return $stmt->fetchAll(PDO::FETCH_ASSOC);
    //     } catch (PDOException $e) {
    //         echo $e->getMessage();
    //     }
    // }
    public function updateMonthlyAssessment($data)
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

    public function getMonthlyChapter($data)
    {
        try {
            $query = "SELECT mc.* 
                    FROM {$this->monthly_chapter_table} mc
                    JOIN {$this->table} ma ON mc.id = ma.monthly_chapter_id
                    WHERE ma.subject_id = :subject_id 
                    AND ma.class_id = :class_id 
                    AND ma.month_no = :month_no 
                    AND ma.year = :year
                    LIMIT 1";

            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':subject_id', $data['subject_id']);
            $stmt->bindParam(':class_id', $data['class_id']);
            $stmt->bindParam(':month_no', $data['month_no']);
            $stmt->bindParam(':year', $data['year']);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    // public function updateMonthlyChapter($data)
    // {
    //     try {
    //         var_dump($data);
    //         $query = "UPDATE {$this->monthly_chapter_table} 
    //                 SET chapter = :chapter,
    //                     learning_outcomes = :learning_outcomes,
    //                     check_points = :check_points,
    //                     updated_at = NOW()
    //                 WHERE id = :id";

    //         $stmt = $this->db->prepare($query);
    //         $stmt->bindParam(':id', $data['id']);
    //         $stmt->bindParam(':chapter', $data['chapter']);
    //         $stmt->bindParam(':learning_outcomes', $data['learning_outcomes']);
    //         $stmt->bindParam(':check_points', $data['check_points']);

    //         return $stmt->execute();
    //     } catch (PDOException $e) {
    //         error_log($e->getMessage());
    //         return false;
    //     }
    // }

    public function updateMonthlyChapterByConditions($data)
    {
        try {
            $sql = "UPDATE {$this->monthly_chapter_table} 
                    SET chapter = :chapter,
                        learning_outcomes = :learning_outcomes,
                        check_points = :check_points,
                        updated_at = NOW()
                    WHERE subject_id = :subject_id 
                    AND class_id = :class_id 
                    AND month_no = :month_no 
                    AND year = :year";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':chapter', $data['chapter']);
            $stmt->bindParam(':learning_outcomes', $data['learning_outcomes']);
            $stmt->bindParam(':check_points', $data['check_points']);
            $stmt->bindParam(':subject_id', $data['subject_id']);
            $stmt->bindParam(':class_id', $data['class_id']);
            $stmt->bindParam(':month_no', $data['month_no']);
            $stmt->bindParam(':year', $data['year']);
            return $stmt->execute();
        } catch (PDOException $e) {
            // Handle error appropriately
            return false;
        }
    }
}
