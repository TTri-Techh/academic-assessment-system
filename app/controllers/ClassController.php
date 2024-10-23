<?php

namespace app\controllers;

use app\models\ClassModel;
use core\db\MySQL;

class ClassController
{
    private $classModel;

    public function __construct()
    {
        $database = new MySQL();
        $db = $database->connect();
        $this->classModel = new ClassModel($db);
    }

    /**
     * Method get all classes G-1 to G-5
     *
     * @return object [Classes object ]
     */
    public function getAllClasses()
    {
        return $this->classModel->getAllClasses();
    }
}
