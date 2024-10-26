<?php

namespace app\models;

use PDO;
use PDOException;

class G0AssessmentModel
{
    private $db;
    private $g0StudentsAssessmentTbl = 'g0_students_assessment';
    private $g0SubjectsTbl = 'g0_subjects';
    private $g0SubjectResultsTbl = 'g0_subject_results';


    public function __construct($db)
    {
        $this->db = $db;
    }
    public function getAllG0Subjects()
    {
        try {
            $query = "SELECT * FROM $this->g0SubjectsTbl";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public function getAllG0SubjectResults()
    {
        try {
            $query = "SELECT * FROM $this->g0SubjectResultsTbl";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public function getG0SubjectResult($subjectId)
    {
        try {
            $query = "SELECT * FROM $this->g0SubjectResultsTbl WHERE subject_id = :subjectId";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':subjectId', $subjectId);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public function getG0SubjectResultsBySubjectId($subjectId)
    {
        try {
            $query = "SELECT * FROM $this->g0SubjectResultsTbl WHERE subject_id = :subjectId";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':subjectId', $subjectId);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public function getG0StudentAssessmentByStudentId($studentId)
    {
        try {
            $query = "SELECT $this->g0StudentsAssessmentTbl.*, $this->g0SubjectsTbl.*, $this->g0SubjectResultsTbl.* 
            FROM $this->g0StudentsAssessmentTbl 
            LEFT JOIN $this->g0SubjectsTbl ON $this->g0StudentsAssessmentTbl.subject_id = $this->g0SubjectsTbl.id 
            LEFT JOIN $this->g0SubjectResultsTbl ON $this->g0StudentsAssessmentTbl.subject_result_id = $this->g0SubjectResultsTbl.id   
            WHERE student_id = :studentId";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':studentId', $studentId);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $assessments = [];
            foreach ($results as $result) {
                $assessments[$result['subject_id']][$result['subject_result_id']] = $result;
            }
            return $assessments;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public function isG0StudentsAssessmentExist($studentId, $year)
    {
        try {
            $query = "SELECT * FROM $this->g0StudentsAssessmentTbl WHERE student_id = :studentId AND year = :year";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':studentId', $studentId);
            $stmt->bindParam(':year', $year);
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public function createG0StudentsAssessment($data)
    {
        try {
            extract($data);
            $query = "INSERT INTO $this->g0StudentsAssessmentTbl (student_id, teacher_id, subject_id, subject_result_id) VALUES (:student_id, :teacher_id, :subject_id, :subject_result_id)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':student_id', $student_id);
            $stmt->bindParam(':teacher_id', $teacher_id);
            $stmt->bindParam(':subject_id', $subject_id);
            $stmt->bindParam(':subject_result_id', $subject_result_id);
            return $stmt->execute();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function updateG0StudentsAssessment($data)
    {
        try {
            $mark_key = array_keys($data)[3]; // This will be 'mark_1', 'mark_2', 'mark_3', or 'mark_4'
            $query = "UPDATE $this->g0StudentsAssessmentTbl SET 
                    $mark_key = :mark
                    WHERE student_id = :student_id AND subject_id = :subject_id AND subject_result_id = :subject_result_id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':student_id', $data['student_id']);
            $stmt->bindParam(':subject_id', $data['subject_id']);
            $stmt->bindParam(':subject_result_id', $data['subject_result_id']);
            $stmt->bindParam(':mark', $data[$mark_key]);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error in updateG0StudentsAssessment: " . $e->getMessage());
            return false;
        }
    }
}
