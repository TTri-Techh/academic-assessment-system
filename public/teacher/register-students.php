<?php

require '../../vendor/autoload.php';
include('../components/header.php');

use app\controllers\StudentController;
use app\controllers\TeacherController;
use core\helpers\AlertHelper;

$teacherAuthController = new TeacherController();
if (!$teacherAuthController->isAuthenticated()) {
    header("Location:login.php");
    exit();
}

$studentController = new StudentController();
if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['submit_btn'])) {
    $studentController->register($_POST);
}

// Display success message if login is successful
if ((isset($_GET['login']) && $_GET['login'] === 'success')) {
    AlertHelper::showAlert('Congratulation', 'You are successfully logged in.', 'success');
} elseif (isset($_GET['register']) && $_GET['register'] === 'success') {
    AlertHelper::showAlert('Registration Succeed', $_SESSION['response'], 'success');
} elseif (isset($_GET['register']) && $_GET['register'] === 'fail') {
    AlertHelper::showAlert('Failed to register.', $_SESSION['response'], 'error');
}


?>


<body>

    <div class="main-wrapper">

        <!-- Sidebar & Navbar -->
        <?php
        include('../components/teacher_sidebar.php');

        include('../components/teacher_navbar.php');
        ?>

        <div class="page-content">

            <div>
                <h4 class="mb-3 mb-md-0">Register Students</h4>
            </div>

            <div class="row">
                <!-- Start Form -->
                <div class="mt-3 col-lg grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">‌‌‌‌‌ကျောင်းသား/သူ၏ အချက်အလက်များဖြည့်သွင်းရန်</h4>
                            <form id="signupForm" method="POST" action="">
                                <input type="text" name="class_id" value="<?= $_SESSION['class_id'] ?>" hidden>
                                <div class="row">

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="enrollment_no" class="form-label">‌ကျောင်းဝင်နံပါတ်</label>
                                            <input id="enrollment_no" class="form-control" name="enrollment_no"
                                                type="text" placeholder="၀၀၀၁" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="name_en" class="form-label">အမည်(အင်္ဂလိပ်)</label>
                                            <input id="name_en" class="form-control" name="name_en" type="text"
                                                placeholder="Mg/Ma..." required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="name_mm" class="form-label">အမည်(မြန်မာ)</label>
                                            <input id="name_mm" class="form-control" name="name_mm" type="text"
                                                placeholder="မောင်/မ..." required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="father_name" class="form-label">အဘအမည်</label>
                                            <input id="father_name" class="form-control" name="father_name" type="text"
                                                placeholder="ဦး.." required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="mother_name" class="form-label">အမိအမည်</label>
                                            <input id="mother_name" class="form-control" name="mother_name" type="text"
                                                placeholder="ဒေါ်.." required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="guardian" class="form-label">အုပ်ထိန်းသူ</label>
                                            <input id="guardian" class="form-control" name="guardian" type="text"
                                                placeholder="ဦး/ဒေါ်.." required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="parent_job" class="form-label">အလုပ်အကိုင်</label>
                                            <input id="parent_job" class="form-control" name="parent_job" type="text"
                                                placeholder="ခြံ" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="address" class="form-label">နေရပ်လိပ်စာ</label>
                                            <input id="address" class="form-control" name="address" type="text"
                                                placeholder="" required>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="phone" class="form-label">ဖုန်းနံပါတ်</label>
                                                <input id="phone" class="form-control" name="phone"
                                                    type="tel" placeholder="09xxxxxxxxx" maxlength="11"
                                                    pattern="[0-9]{2}[0-9]{9}" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="dob" class="form-label">မွေးသက္ကရာဇ်</label>
                                                <input id="dob" class="form-control" name="dob" type="date" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <input name="submit_btn" class="btn btn-primary" type="submit" value="ထည့်သွင်းမည်">
                            </form>
                        </div>
                    </div>
                </div>
                <!-- End Form -->
            </div>

        </div>
    </div>
</body>

<!--  JavaScript -->
<?php
include('../components/script.php');
?>