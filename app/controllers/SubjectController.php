<?php

namespace app\controllers;

use app\models\SubjectModel;
use core\db\MySQL;


class SubjectController
{
    private $subjectModel;

    public function __construct()
    {
        $database = new MySQL();
        $db = $database->connect();
        $this->subjectModel = new SubjectModel($db);
    }
    public function getSubjectNameById($subject_id)
    {
        return $this->subjectModel->getSubjectNameById($subject_id);
    }
    public function getMainSubjects()
    {
        return $this->subjectModel->getMainSubjects();
    }
}
