<?php

namespace app\controllers;

use app\models\QcprModel;
use core\db\MySQL;
use core\helpers\Helper;

class QcprController
{
    private $qcprModel;

    public function __construct()
    {
        $database = new MySQL();
        $db = $database->connect();
        $this->qcprModel = new QcprModel($db);
    }


    // calculate average assessment
    public function getQcpr($data)
    {
        if ($_SESSION['class_id'] == 4 || $_SESSION['class_id'] == 5) {
            return $this->qcprModel->getUpperQcpr($data); //for G4, G5
        } else {
            return $this->qcprModel->getLowerQcpr($data); //for G1, G2, G3
        }
    }

    public function getAnnouncementStatus()
    {
        return $this->qcprModel->getAnnouncementStatus($_SESSION['class_id']);
    }

    public function changeAnnouncementStatus($status)
    {
        $result = $this->qcprModel->updateAnnouncement($_SESSION['class_id'], $_SESSION['teacher_id'], $status);
        if ($result) {
            $_SESSION['announcement_status'] = $status;
            return true;
        }
        return false;
    }
}
