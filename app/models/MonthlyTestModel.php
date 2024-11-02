<?php

namespace app\models;

use PDO;
use PDOException;

class MonthlyTestModel
{
    private $db;
    private $table = 'monthly_test';
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function createMonthlyTest($assessmentDataArray)
    {
        try {
            // Create assessment for each student
            foreach ($assessmentDataArray as $data) {
                $query = "INSERT INTO {$this->table} 
                        (student_id,class_id, teacher_id, month_no, year) 
                        VALUES 
                        (:student_id, :class_id, :teacher_id, :month_no, :year)";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(':student_id', $data['student_id']);
                $stmt->bindParam(':teacher_id', $data['teacher_id']);
                $stmt->bindParam(':class_id', $data['class_id']);
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

    public function checkMonthlyTestIsCreated($data)
    {
        try {
            extract($data);
            $query = "SELECT * FROM {$this->table} WHERE class_id = :class_id AND month_no = :month_no AND year = :year";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':class_id', $class_id);
            $stmt->bindParam(':month_no', $month_no);
            $stmt->bindParam(':year', $year);
            $stmt->execute();
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getAllMonthlyTest($data)
    {
        try {
            extract($data);
            $query = "SELECT {$this->table}.*,students.enrollment_no, students.name_mm as student_name, students.father_name as father_name 
                    FROM {$this->table}
                    JOIN students ON {$this->table}.student_id = students.id
                    WHERE {$this->table}.class_id = :class_id 
                    AND {$this->table}.month_no = :month_no 
                    AND {$this->table}.year = :year";
            $stmt = $this->db->prepare($query);
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
    public function updateMonthlyTest($data)
    {
        try {
            extract($data);
            $query = "UPDATE {$this->table} SET myanmar_mark = :myanmar_mark, myanmar_grade = :myanmar_grade, english_mark = :english_mark, english_grade = :english_grade, math_mark = :math_mark, math_grade = :math_grade, science_mark = :science_mark, science_grade = :science_grade, social_mark = :social_mark, social_grade = :social_grade, total_mark = :total_mark, total_grade = :total_grade, result = :result WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':myanmar_mark', $myanmar_mark);
            $stmt->bindParam(':myanmar_grade', $myanmar_grade);
            $stmt->bindParam(':english_mark', $english_mark);
            $stmt->bindParam(':english_grade', $english_grade);
            $stmt->bindParam(':math_mark', $math_mark);
            $stmt->bindParam(':math_grade', $math_grade);
            $stmt->bindParam(':science_mark', $science_mark);
            $stmt->bindParam(':science_grade', $science_grade);
            $stmt->bindParam(':social_mark', $social_mark);
            $stmt->bindParam(':social_grade', $social_grade);
            $stmt->bindParam(':total_mark', $total_mark);
            $stmt->bindParam(':total_grade', $total_grade);
            $stmt->bindParam(':result', $result);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    // public function updateChapterByConditions($data)
    // {
    //     try {
    //         $sql = "UPDATE {$this->table} 
    //                 SET myanmar_mark = :myanmar_mark,
    //                     myanmar_grade = :myanmar_grade,
    //                     english_mark = :english_mark,
    //                     english_grade = :english_grade,
    //                     math_mark = :math_mark,
    //                     math_grade = :math_grade,
    //                     science_mark = :science_mark,
    //                     science_grade = :science_grade,
    //                     social_mark = :social_mark,
    //                     social_grade = :social_grade,
    //                     updated_at = NOW()
    //                 WHERE student_id = :student_id 
    //                 AND class_id = :class_id 
    //                 AND month_no = :month_no 
    //                 AND year = :year";
    //         $stmt = $this->db->prepare($sql);
    //         $stmt->bindParam(':myanmar_mark', $data['myanmar_mark']);
    //         $stmt->bindParam(':myanmar_grade', $data['myanmar_grade']);
    //         $stmt->bindParam(':english_mark', $data['english_mark']);
    //         $stmt->bindParam(':english_grade', $data['english_grade']);
    //         $stmt->bindParam(':math_mark', $data['math_mark']);
    //         $stmt->bindParam(':math_grade', $data['math_grade']);
    //         $stmt->bindParam(':science_mark', $data['science_mark']);
    //         $stmt->bindParam(':science_grade', $data['science_grade']);
    //         $stmt->bindParam(':social_mark', $data['social_mark']);
    //         $stmt->bindParam(':social_grade', $data['social_grade']);
    //         $stmt->bindParam(':class_id', $data['class_id']);
    //         $stmt->bindParam(':month_no', $data['month_no']);
    //         $stmt->bindParam(':year', $data['year']);
    //         return $stmt->execute();
    //     } catch (PDOException $e) {
    //         // Handle error appropriately
    //         return false;
    //     }
    // }

    public function getMonthlyTestByStudentId($student_id, $class_id)
    {
        try {
            // get subject id, mark, month_no, year
            $query = "SELECT * FROM {$this->table} WHERE student_id = :student_id AND class_id = :class_id AND year = NOW() ORDER BY month_no ASC";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':student_id', $student_id);
            $stmt->bindParam(':class_id', $class_id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    public function deleteMonthlyTest($data)
    {
        try {
            extract($data);
            $query = "DELETE FROM {$this->table} WHERE class_id = :class_id AND month_no = :month_no AND year = :year";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':class_id', $class_id);
            $stmt->bindParam(':month_no', $month_no);
            $stmt->bindParam(':year', $year);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
