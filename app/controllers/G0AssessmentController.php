<?php

namespace app\controllers;

use app\models\G0AssessmentModel;
use core\db\MySQL;

class G0AssessmentController
{
    private $g0AssessmentModel;

    public function __construct()
    {
        $database = new MySQL();
        $db = $database->connect();
        $this->g0AssessmentModel = new G0AssessmentModel($db);
    }
    public function getAllG0Subjects()
    {
        return $this->g0AssessmentModel->getAllG0Subjects();
    }
    public function getG0SubjectResults()
    {
        return $this->g0AssessmentModel->getAllG0SubjectResults();
    }

    public function createG0Assessment($student_id)
    {
        // check if assessment already exists   
        $assessment = $this->g0AssessmentModel->getG0StudentAssessmentByStudentId($student_id);
        if (empty($assessment)) {
            $subjects = $this->g0AssessmentModel->getAllG0Subjects();

            foreach ($subjects as $subject) {
                $subjectResults = $this->g0AssessmentModel->getG0SubjectResultsBySubjectId($subject['id']);
                foreach ($subjectResults as $subjectResult) {
                    $assessmentData = [
                        'subject_id' => $subject['id'],
                        'subject_result_id' => $subjectResult['id'],
                        'teacher_id' => $_SESSION['teacher_id'],
                        'student_id' => $student_id,
                        'mark_1' => null,
                        'mark_2' => null,
                        'mark_3' => null,
                        'mark_4' => null
                    ];
                    $this->g0AssessmentModel->createG0StudentsAssessment($assessmentData);
                }
            }
        }
    }
    public function updateG0Assessment($data)
    {
        if (!isset($data['id'])) {
            error_log("Error: 'id' is missing in updateG0Assessment");
            return false;
        }

        $student_id = $data['id'];
        $updated = false;

        for ($i = 1; $i <= 4; $i++) {
            $mark_key = "mark_$i";
            if (isset($data[$mark_key]) && is_array($data[$mark_key])) {
                foreach ($data[$mark_key] as $subject_id => $subject_results) {
                    if (!is_array($subject_results)) {
                        continue;
                    }
                    foreach ($subject_results as $subject_result_id => $mark) {
                        $assessmentData = [
                            'student_id' => $student_id,
                            'subject_id' => $subject_id,
                            'subject_result_id' => $subject_result_id,
                            $mark_key => $mark
                        ];
                        $result = $this->g0AssessmentModel->updateG0StudentsAssessment($assessmentData);
                        if ($result) {
                            $updated = true;
                        }
                    }
                }
            }
        }

        return $updated;
    }
    public function getG0SubjectResultsBySubjectId($subjectId)
    {
        return $this->g0AssessmentModel->getG0SubjectResultsBySubjectId($subjectId);
    }
    public function getG0AssessmentByStudentId($studentId)
    {
        return $this->g0AssessmentModel->getG0StudentAssessmentByStudentId($studentId);
    }
}
