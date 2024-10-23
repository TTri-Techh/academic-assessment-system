<?php

require '../../vendor/autoload.php';
include('../components/header.php');

use app\controllers\AdminAuthController;
use app\controllers\TeacherController;
use core\helpers\AlertHelper;

$adminAuthController = new AdminAuthController();
$teacherController = new TeacherController();
if (!$adminAuthController->isAuthenticated()) {
    header("Location:login.php");
    exit();
}

$teachers = $teacherController->getAllTeachers();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update-btn'])) {
    $teacherController->updateTeacherById($_POST);
} elseif (isset($_GET['update']) && $_GET['update'] === 'success') {
    AlertHelper::showAlert('Updated!', 'Updated a teacher data successfully.', 'success');
} elseif (isset($_GET['update']) && $_GET['update'] === 'fail') {
    AlertHelper::showAlert('Failed to update.', 'Something went wrong.', 'error');
} elseif (isset($_GET['delete']) && $_GET['delete'] === 'true') {
    $id = (int)$_GET['id'];
    $teacherController->deleteTeacherById($id);
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

            <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
                <div>
                    <h4 class="mb-3 mb-md-0">Teachers</h4>
                </div>
            </div>

            <!-- Start Data Table -->

            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">ဆရာ/ဆရာမများ </h6>
                            <div class="table-responsive">
                                <table id="teachersTable" class="table ">
                                    <thead>
                                        <tr>
                                            <th>စဉ်</th>
                                            <th>အမည်</th>
                                            <th>အသုံးပြုသူအမည်</th>
                                            <th>မိဘအမည်</th>
                                            <th>ရာထူး</th>
                                            <th>ပညာအရည်အချင်း</th>
                                            <th>မွေးသက္ကရာဇ်</th>
                                            <th class="text-primary">စတင်ဝင်ရောက်သည့်အချိန် <br> ပညာရေးဌာန</th>
                                            <th class="text-primary"> <br> လက်ရှိရာထူး</th>
                                            <th class="text-primary"> <br> လက်ရှိကျောင်း</th>
                                            <th>B.E.D ပြီးမပြီး</th>
                                            <th>ဖောင်ကြီး ပြီးမပြီး</th>
                                            <th>တက်ရောက်ပြီးသင်တန်း</th>
                                            <th>Status</th>
                                            <th>ဖုန်း/နေရပ်လိပ်စာ</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $count = 1; ?>
                                        <?php foreach ($teachers as $teacher) : ?>
                                            <tr>
                                                <td><?= $count ?></td>
                                                <td><?= htmlspecialchars($teacher['name_mm']) ?></td>
                                                <td><?= htmlspecialchars($teacher['username']) ?></td>
                                                <td><?= htmlspecialchars($teacher['father_name']) ?> <br> <?= htmlspecialchars($teacher['mother_name']) ?> </td>
                                                <td><?= htmlspecialchars($teacher['rank']) ?></td>
                                                <td><?= htmlspecialchars($teacher['education']) ?></td>
                                                <td><?= htmlspecialchars($teacher['dob']) ?></td>
                                                <td><?= htmlspecialchars($teacher['start_edu_at']) ?></td>
                                                <td><?= htmlspecialchars($teacher['start_current_rank_at']) ?></td>
                                                <td><?= htmlspecialchars($teacher['start_current_school_at']) ?></td>
                                                <td><?= htmlspecialchars($teacher['bed_status']) ?></td>
                                                <td><?= htmlspecialchars($teacher['phaung_gyi_status']) ?></td>
                                                <td><?= htmlspecialchars($teacher['completed_course']) ?></td>
                                                <td><span class="badge <?= $teacher['status'] == 'active' ? 'bg-success' : 'bg-danger' ?> "><?= htmlspecialchars($teacher['status']) ?></span></td>
                                                <td><?= htmlspecialchars($teacher['phone']) ?> <br> <?= htmlspecialchars($teacher['address']) ?></td>
                                                <td class="d-flex align-items-center">
                                                    <!-- </button> -->
                                                    <a class="" href="edit-teacher.php?id=<?= htmlspecialchars($teacher['id']) ?>"><i data-feather="edit-2" class="icon-sm me-2"></i></a>
                                                    <a class="" href="javascript:;" onclick="<?= AlertHelper::confirmDelete($teacher['id'], 'Do you want to delete this teacher?', 'view-teachers.php?delete=true&id='); ?>">
                                                        <i data-feather="trash" class="icon-sm me-2 text-danger"></i>
                                                    </a>
                                                </td>

                                            </tr>
                                            <?php $count++; ?>
                                        <?php endforeach ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Data Table -->

        </div>
    </div>
</body>
<?php
include('../components/script.php');
?>