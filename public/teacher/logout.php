<?php

require '../../vendor/autoload.php';

use app\controllers\TeacherController;

$teacherConroller = new TeacherController();
$teacherConroller->logout();