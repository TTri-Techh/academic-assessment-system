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
    public function getResourceById($id)
    {
        return $this->resourcesModel->getResourceById($id);
    }
    public function updateResource($data, $id)
    {
        return $this->resourcesModel->updateResource($data, $id);
    }
    public function deleteResource($id)
    {
        return $this->resourcesModel->deleteResource($id);
    }
    public function getResourceFiles($resource_id)
    {
        return $this->resourcesModel->getResourceFiles($resource_id);
    }
    public function getResourcesByTeacher($teacherId)
    {
        return $this->resourcesModel->getResourcesByTeacher($teacherId);
    }
    public function deleteFile($file_id)
    {
        return $this->resourcesModel->deleteFile($file_id);
    }
    public function addNewFiles($resource_id, $filesArr)
    {
        return $this->resourcesModel->addNewFiles($resource_id, $filesArr);
    }
    public function getResourcesByClassId($classId)
    {
        return $this->resourcesModel->getResourcesByClassId($classId);
    }
}
