<?php

require '../../vendor/autoload.php';
include('../components/header.php');

use app\controllers\AdminAuthController;
use app\controllers\TeacherController;

// Redirect to login page if not authenticated
$adminAuthController = new AdminAuthController();
if (!$adminAuthController->isAuthenticated()) {
    header("Location:login.php");
    exit();
}

$teacherController = new TeacherController();

if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['submit_btn'])) {
    $teacherController->register($_POST);
}

?>

<body>
    <div class="main-wrapper">

        <!-- Sidebar & Navbar -->
        <?php
        include('../components/admin_sidebar.php');

        include('../components/admin_navbar.php');
        ?>

        <div class="page-content">

            <div>
                <h4 class="mb-3 mb-md-0">Register Teachers</h4>
            </div>

            <div class="row">
                <!-- Start Left Form -->
                <div class="mt-3 col-lg-8 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">ဆရာ/ဆရာမများ၏ အချက်အလက်များဖြည့်သွင်းရန်</h4>
                            <form id="signupForm" method="POST" action="">
                                <div class="mb-3">
                                    <label for="name" class="form-label">အမည်</label>
                                    <input id="name" class="form-control" name="name" type="text" placeholder="name" required>
                                </div>
                                <!-- <div class="mb-3">
                                    <label for="name" class="form-label">အသုံးပြုသူအမည်</label>
                                    <input id="name" class="form-control" name="name" type="text" placeholder="username" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">အီးမေးလ်</label>
                                    <input id="email" class="form-control" name="email" type="email" placeholder="email" required>
                                </div> -->
                                <div class="mb-3">
                                    <label for="phone" class="form-label">ဖုန်းနံပါတ်</label>
                                    <input id="phone" class="form-control" name="phone" type="phone" placeholder="phone" max="11" required>
                                </div>
                                <!-- <div class="mb-3">
                                    <label for="password" class="form-label">လျှို့ဝှက်စကားလုံး</label>
                                    <input id="password" class="form-control" name="password" type="password" placeholder="123456" value="123456" required>
                                </div> -->
                                <input name="submit_btn" class="btn btn-primary" type="submit" value="ထည့်သွင်းမည်">
                            </form>
                        </div>
                    </div>
                </div>
                <!-- End Form -->

                <div class="mt-3 col-lg-4 grid-margin stretch-card">

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Excel File ဖြင့်ဖြည့်သွင်းရန်</h4>
                            <form id="signupForm">
                                <div class="mb-3">
                                    <label for="file" class="form-label">ဖိုင်ရွေးရန်</label>
                                    <input id="file" class="form-control" name="file" type="file">
                                </div>
                                <input class="btn btn-primary" type="submit" value="ထည့်သွင်းမည်">

                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</body>

<!--  JavaScript -->
<?php
include('../components/script.php');
?>