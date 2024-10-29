<?php

namespace app\controllers;

use app\models\MonthlyAssessmentModel;
use core\db\MySQL;

class MonthlyAssessmentController
{
    private $monthlyAssessmentModel;

    public function __construct()
    {
        $database = new MySQL();
        $db = $database->connect();
        $this->monthlyAssessmentModel = new MonthlyAssessmentModel($db);
    }

    public function createMonthlyAssessment($data)
    {
        return $this->monthlyAssessmentModel->createMonthlyAssessment($data);
    }
    public function checkAssessmentIsCreated($data)
    {
        return $this->monthlyAssessmentModel->checkAssessmentIsCreated($data);
    }
    public function getAllMonthlyAssessment($data)
    {
        return $this->monthlyAssessmentModel->getAllMonthlyAssessment($data);
    }
    public function updateMonthlyAssessment($data)
    {
        return $this->monthlyAssessmentModel->updateMonthlyAssessment($data);
    }

    public function getMonthlyChapter($data)
    {
        return $this->monthlyAssessmentModel->getMonthlyChapter($data);
    }

    public function updateMonthlyChapterByConditions($data)
    {
        return $this->monthlyAssessmentModel->updateMonthlyChapterByConditions($data);
    }

    public function getMonthlyAssessmentByStudentId($student_id, $class_id)
    {
        return $this->monthlyAssessmentModel->getMonthlyAssessmentByStudentId($student_id, $class_id);
    }
}
