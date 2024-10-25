<?php

require '../../vendor/autoload.php';
include('../components/header.php');

use app\controllers\AdminAuthController;
use app\controllers\TeacherController;
session_start();

// Redirect to login page if not authenticated
$adminAuthController = new AdminAuthController();

if (!$adminAuthController->isAuthenticated()) {
    header("Location:login.php");
    exit();
}

$id = $_GET["id"];
$teacherController = new TeacherController();
$teacher = $teacherController->getTeacherById($id);


if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['submit_btn'])) {
    var_dump($_POST);
    $teacherController->updateTeacherById($_POST);
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
                <h4 class="mb-3 mb-md-0">Edit Teacher</h4>
            </div>

            <div class="row">
                <!-- Start Left Form -->
                <div class="mt-3 col-lg grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">ဆရာ/ဆရာမ၏ အချက်အလက်များပြင်ရန်</h4>
                            <form id="editForm" method="POST" action="">
                                <input type="text" hidden name="id" value="<?= $teacher->id ?>">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="name_eng" class="form-label">အမည်(အင်္ဂလိပ်)</label>
                                            <input id="name_eng" class="form-control" name="name_eng" type="text"
                                                placeholder="U/Daw..." required value="<?= $teacher->name_eng ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="name_mm" class="form-label">အမည်(မြန်မာ)</label>
                                            <input id="name_mm" class="form-control" name="name_mm" type="text"
                                                placeholder="ဦး/ဒေါ်..." required value="<?= $teacher->name_mm ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="father_name" class="form-label">အဘအမည်</label>
                                            <input id="father_name" class="form-control" name="father_name" type="text"
                                                placeholder="ဦး.." required value="<?= $teacher->father_name ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="mother_name" class="form-label">အမိအမည်</label>
                                            <input id="mother_name" class="form-control" name="mother_name" type="text"
                                                placeholder="ဒေါ်.." required value="<?= $teacher->mother_name ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="rank" class="form-label">ရာထူး</label>
                                            <input id="rank" class="form-control" name="rank" type="text"
                                                placeholder="လ/ထ မူပြ" required value="<?= $teacher->rank ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="education" class="form-label">ပညာအရည်အချင်း</label>
                                            <input id="education" class="form-control" name="education" type="text"
                                                placeholder="B.Sc(Phys:)" required value="<?= $teacher->education ?>">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="phone" class="form-label">ဖုန်းနံပါတ်</label>
                                                <input id="phone" class="form-control" name="phone" type="tel"
                                                    placeholder="09xxxxxxxxx" maxlength="11" pattern="[0-9]{2}[0-9]{9}"
                                                    required value="<?= $teacher->phone ?>">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="dob" class="form-label">မွေးသက္ကရာဇ်</label>
                                                <input id="dob" class="form-control" name="dob" type="date" required
                                                    value="<?= $teacher->dob ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="completed_course" class="form-label">တက်ရောက်ပြီးသင်တန်း</label>
                                            <input id="completed_course" class="form-control" name="completed_course"
                                                type="text" placeholder="" required
                                                value="<?= $teacher->completed_course ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="address" class="form-label">နေရပ်လိပ်စာ</label>
                                            <input id="address" class="form-control" name="address" type="text"
                                                placeholder="" required value="<?= $teacher->address ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">B.E.D ပြီးမပြီး</label>
                                            <select class="form-select" name="bed_status">
                                                <option value="မပြီး"
                                                    <?= $teacher->bed_status == 'မပြီး' ? 'selected' : '' ?>>မပြီး
                                                </option>
                                                <option value="ပြီး"
                                                    <?= $teacher->bed_status == 'ပြီး' ? 'selected' : '' ?>>ပြီး
                                                </option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">ဖောင်ကြီး ပြီးမပြီး</label>
                                            <select class="form-select" name="phaung_gyi_status">
                                                <option value="မပြီး"
                                                    <?= $teacher->phaung_gyi_status == 'မပြီး' ? 'selected' : '' ?>>
                                                    မပြီး</option>
                                                <option value="ပြီး"
                                                    <?= $teacher->phaung_gyi_status == 'ပြီး' ? 'selected' : '' ?>>ပြီး
                                                </option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Status</label>
                                            <select class="form-select" name="status">
                                                <option value="inactive"
                                                    <?= $teacher->status == 'inactive' ? 'selected' : '' ?>>inactive
                                                </option>
                                                <option value="active"
                                                    <?= $teacher->status == 'active' ? 'selected' : '' ?>>active
                                                </option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="password" class="form-label">လျှို့ဝှက်စကားလုံး</label>
                                            <input id="password" class="form-control" name="password" type="text"
                                                placeholder="" required value="<?= $teacher->password ?>">
                                        </div>
                                        <label for="dob" class="form-label">စတင်ဝင်ရောက်သည့်အချိန်</label>
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label for="start_edu_at" class="form-label">ပညာရေးဌာန</label>
                                                <input id="start_edu_at" class="form-control" name="start_edu_at"
                                                    type="date" required value="<?= $teacher->start_edu_at ?>">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="start_current_rank_at"
                                                    class="form-label">လက်ရှိရာထူး</label>
                                                <input id="start_current_rank_at" class="form-control"
                                                    name="start_current_rank_at" type="date" required
                                                    value="<?= $teacher->start_current_rank_at ?>">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="start_current_school_at"
                                                    class="form-label">လက်ရှိကျောင်း</label>
                                                <input id="start_current_school_at" class="form-control"
                                                    name="start_current_school_at" type="date" required
                                                    value="<?= $teacher->start_current_school_at ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <input name="submit_btn" class="btn btn-primary" type="submit" value="သိမ်းမည်">
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