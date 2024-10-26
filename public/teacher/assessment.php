<?php

require '../../vendor/autoload.php';
include('../components/header.php');

use app\controllers\StudentController;
use app\controllers\TeacherController;
use core\helpers\AlertHelper;


$teacherController = new TeacherController();
$studentController = new StudentController();
if (!$teacherController->isAuthenticated()) {
    header("Location:login.php");
    exit();
}

$students = $studentController->getAllStudents();

// if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update-btn'])) {
//     $studentController->updateStudentById($_POST);
// } elseif (isset($_GET['update']) && $_GET['update'] === 'success') {
//     AlertHelper::showAlert('Updated!', 'Updated a student data successfully.', 'success');
// } elseif (isset($_GET['update']) && $_GET['update'] === 'fail') {
//     AlertHelper::showAlert('Failed to update.', 'Something went wrong.', 'error');
// } elseif (isset($_GET['delete']) && $_GET['delete'] === 'true') {
//     $id = (int) $_GET['id'];
//     $studentController->deleteStudentById($id);
// }
?>


<body>

    <div class="main-wrapper">

        <!-- Sidebar & Navbar -->
        <?php
        include('../components/teacher_sidebar.php');

        include('../components/teacher_navbar.php');
        ?>

        <div class="page-content">

            <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
                <div>
                    <h4 class="mb-3 mb-md-0">သင်ယူမှုရလဒ်မှတ်တမ်းများ</h4>
                </div>
            </div>

            <!-- Start Data Table -->

            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="studentsTable" class="table ">
                                    <thead>
                                        <tr>
                                            <th>စဉ်</th>
                                            <th>ကျောင်းသူ/သားအမည်</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $count = 1; ?>
                                        <?php foreach ($students as $student): ?>
                                            <?php
                                            $studentId = $student['id'];
                                            ?>

                                            <tr>
                                                <td><?= $count ?></td>
                                                <td><?= htmlspecialchars($student['name_mm']) ?></td>
                                                </td>
                                                <td class="d-flex align-items-center">
                                                    <a class=""
                                                        href="g0-assessment.php?id=<?= htmlspecialchars($student['id']) ?>">
                                                        <!-- <i data-feather="edit-2" class="icon-sm me-2"></i> -->
                                                        ထည့်သွင်းရန်
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