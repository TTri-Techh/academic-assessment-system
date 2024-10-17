<?php

require '../../vendor/autoload.php';

use app\controllers\AdminAuthController;

$adminAuthConroller = new AdminAuthController();
$adminAuthConroller->logout();
