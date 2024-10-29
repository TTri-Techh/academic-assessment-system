<?php

namespace app\controllers;

use app\models\MonthlyTestModel;
use core\db\MySQL;

class MonthlyTestController
{
    private $monthlyTestModel;

    public function __construct()
    {
        $database = new MySQL();
        $db = $database->connect();
        $this->monthlyTestModel = new MonthlyTestModel($db);
    }

    public function createMonthlyTest($data)
    {
        return $this->monthlyTestModel->createMonthlyTest($data);
    }
    public function checkMonthlyTestIsCreated($data)
    {
        return $this->monthlyTestModel->checkMonthlyTestIsCreated($data);
    }
    public function getAllMonthlyTest($data)
    {
        return $this->monthlyTestModel->getAllMonthlyTest($data);
    }
    public function updateMonthlyTest($data)
    {
        return $this->monthlyTestModel->updateMonthlyTest($data);
    }
    // public function updateMonthlyTestByConditions($data)
    // {
    //     return $this->monthlyTestModel->updateMonthlyTestByConditions($data);
    // }

    public function getMonthlyTestByStudentId($student_id, $class_id)
    {
        return $this->monthlyTestModel->getMonthlyTestByStudentId($student_id, $class_id);
    }
}
