<?php

require '../../vendor/autoload.php';

use app\controllers\StudentController;

$studentController = new StudentController();
$studentController->logout();
