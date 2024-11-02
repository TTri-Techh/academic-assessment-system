<?php

namespace app\controllers;

use app\models\ChapterlyAssessmentModel;
use core\db\MySQL;

class ChapterlyAssessmentController
{
    private $chapterlyAssessmentModel;

    public function __construct()
    {
        $database = new MySQL();
        $db = $database->connect();
        $this->chapterlyAssessmentModel = new ChapterlyAssessmentModel($db);
    }

    public function createChapterlyAssessment($data)
    {
        return $this->chapterlyAssessmentModel->createChapterlyAssessment($data);
    }
    public function checkAssessmentIsCreated($data)
    {
        return $this->chapterlyAssessmentModel->checkAssessmentIsCreated($data);
    }
    public function getAllChapterlyAssessment($data)
    {
        return $this->chapterlyAssessmentModel->getAllChapterlyAssessment($data);
    }
    public function updateChapterlyAssessment($data)
    {
        return $this->chapterlyAssessmentModel->updateChapterlyAssessment($data);
    }

    public function getChapter($data)
    {
        return $this->chapterlyAssessmentModel->getChapter($data);
    }

    public function updateChapterByConditions($data)
    {
        return $this->chapterlyAssessmentModel->updateChapterByConditions($data);
    }
    public function deleteChapterlyAssessment($data)
    {
        return $this->chapterlyAssessmentModel->deleteChapterlyAssessment($data);
    }
    public function deleteAllChapterlyAssessment($data)
    {
        return $this->chapterlyAssessmentModel->deleteAllChapterlyAssessment($data);
    }
}
