<?php

require '../../vendor/autoload.php';
include('../components/header.php');

use app\controllers\AdminAuthController;
use app\controllers\TeacherController;
use core\helpers\AlertHelper;


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

if (isset($_GET['register']) && $_GET['register'] === 'success') {
    AlertHelper::showAlert('Registration Succeed', $_SESSION['response'], 'success');
} elseif (isset($_GET['register']) && $_GET['register'] === 'fail') {
    AlertHelper::showAlert('Failed to register.', $_SESSION['response'], 'error');
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
                <div class="mt-3 col-lg grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">ဆရာ/ဆရာမ၏ အချက်အလက်များဖြည့်သွင်းရန်</h4>
                            <form id="signupForm" method="POST" action="">
                                <div class="row">

                                    <div class="col-lg-6">

                                        <div class="mb-3">
                                            <label for="name_eng" class="form-label">အမည်(အင်္ဂလိပ်)</label>
                                            <input id="name_eng" class="form-control" name="name_eng" type="text"
                                                placeholder="U/Daw..." required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="name_mm" class="form-label">အမည်(မြန်မာ)</label>
                                            <input id="name_mm" class="form-control" name="name_mm" type="text"
                                                placeholder="ဦး/ဒေါ်..." required>
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
                                        <div class="mb-3">
                                            <label for="rank" class="form-label">ရာထူး</label>
                                            <input id="rank" class="form-control" name="rank" type="text"
                                                placeholder="လ/ထ မူပြ" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="education" class="form-label">ပညာအရည်အချင်း</label>
                                            <input id="education" class="form-control" name="education" type="text"
                                                placeholder="B.Sc(Phys:)" required>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="phone" class="form-label">ဖုန်းနံပါတ်</label>
                                                <input id="phone" class="form-control" name="phone" type="tel"
                                                    placeholder="09xxxxxxxxx" maxlength="11" pattern="[0-9]{2}[0-9]{9}"
                                                    required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="dob" class="form-label">မွေးသက္ကရာဇ်</label>
                                                <input id="dob" class="form-control" name="dob" type="date" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="completed_course" class="form-label">တက်ရောက်ပြီးသင်တန်း</label>
                                            <input id="completed_course" class="form-control" name="completed_course"
                                                type="text" placeholder="" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="address" class="form-label">နေရပ်လိပ်စာ</label>
                                            <input id="address" class="form-control" name="address" type="text"
                                                placeholder="" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">B.E.D ပြီးမပြီး</label>
                                            <select class="form-select" name="bed_status">
                                                <option value="မပြီး">မပြီး</option>
                                                <option value="ပြီး">ပြီး</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">ဖောင်ကြီး ပြီးမပြီး</label>
                                            <select class="form-select" name="phaung_gyi_status">
                                                <option value="မပြီး">မပြီး</option>
                                                <option value="ပြီး">ပြီး</option>
                                            </select>
                                        </div>
                                        <label for="dob" class="form-label">စတင်ဝင်ရောက်သည့်အချိန်</label>
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label for="start_edu_at" class="form-label">ပညာရေးဌာန</label>
                                                <input id="start_edu_at" class="form-control" name="start_edu_at"
                                                    type="date" required>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="start_current_rank_at"
                                                    class="form-label">လက်ရှိရာထူး</label>
                                                <input id="start_current_rank_at" class="form-control"
                                                    name="start_current_rank_at" type="date" required>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="start_current_school_at"
                                                    class="form-label">လက်ရှိကျောင်း</label>
                                                <input id="start_current_school_at" class="form-control"
                                                    name="start_current_school_at" type="date" required>
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