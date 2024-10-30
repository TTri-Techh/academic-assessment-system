<?php

namespace app\controllers;

use app\models\ResourcesModel;
use core\db\MySQL;

class ResourcesController
{
    private $resourcesModel;

    public function __construct()
    {
        $database = new MySQL();
        $db = $database->connect();
        $this->resourcesModel = new ResourcesModel($db);
    }
    public function createResource($data, $filesArr)
    {
        $this->resourcesModel->createResource($data, $filesArr);
    }
    public function getAllResources($class_id, $chapter_no)
    {
        return $this->resourcesModel->getAllResources($class_id, $chapter_no);
    }
}
