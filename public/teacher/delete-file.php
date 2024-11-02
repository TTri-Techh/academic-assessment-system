<?php
require '../../vendor/autoload.php';
session_start();

use app\controllers\ResourcesController;
use app\controllers\TeacherController;

$teacherController = new TeacherController();
if (!$teacherController->isAuthenticated()) {
    header("Location: login.php");
    exit();
}

$file_id = $_GET['file_id'] ?? 0;
$resource_id = $_GET['resource_id'] ?? 0;

if ($file_id && $resource_id) {
    $resourceController = new ResourcesController();
    if ($resourceController->deleteFile($file_id)) {
        $_SESSION['alert'] = [
            'type' => 'success',
            'title' => 'Success!',
            'message' => 'File deleted successfully.'
        ];
    }
}

echo "<script>window.location.href = 'edit-resource.php?id=" . $resource_id . "';</script>";
exit();
