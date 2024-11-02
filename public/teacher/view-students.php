<?php

require '../../vendor/autoload.php';
include('../components/header.php');

use app\controllers\StudentController;
use app\controllers\TeacherController;
use app\controllers\MonthlyAssessmentController;
use app\controllers\ChapterlyAssessmentController;
use app\controllers\MonthlyTestController;
use core\helpers\AlertHelper;
use core\helpers\Helper;

$teacherController = new TeacherController();
$studentController = new StudentController();
if (!$teacherController->isAuthenticated()) {
    header("Location:login.php");
    exit();
}

$students = $studentController->getStudentsByClassId($_SESSION['class_id']); // get all students by class id

if (empty($students)) {
    $_SESSION['error'] = "ကျောင်းသား/သူများ ဦးစွာထည့်သွင်းပါ။";
    echo "<script>
        alert('ကျောင်းသား/သူများ ဦးစွာထည့်သွင်းပါ။');
        window.location.href = 'register-students.php';
    </script>";
    exit;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update-btn'])) {
    $studentController->updateStudentById($_POST);
} elseif (isset($_GET['update']) && $_GET['update'] === 'success') {
    AlertHelper::showAlert('Updated!', 'Updated a student data successfully.', 'success');
} elseif (isset($_GET['update']) && $_GET['update'] === 'fail') {
    AlertHelper::showAlert('Failed to update.', 'Something went wrong.', 'error');
} elseif (isset($_GET['delete']) && $_GET['delete'] === 'true') {
    $id = (int) $_GET['id'];
    $studentController->deleteStudentById($id);
} elseif (isset($_GET['deleteAssessments']) && $_GET['deleteAssessments'] === 'true') {
    AlertHelper::showAlert('Deleted!', 'Deleted all assessments successfully.', 'success');
} elseif (isset($_GET['deleteAssessments']) && $_GET['deleteAssessments'] === 'fail') {
    AlertHelper::showAlert('Failed to delete.', 'Something went wrong.', 'error');
}

$checkAssessmentData = [
    'class_id' => $_SESSION['class_id'],
    'year' => date('Y')
];

$monthlyAssessmentController = new MonthlyAssessmentController();
$chapterlyAssessmentController = new ChapterlyAssessmentController();
$monthlyTestController = new MonthlyTestController();
// reset all assessment
if (isset($_POST['reset'])) {
    $monthlyAssessmentController->deleteAllMonthlyAssessment($checkAssessmentData);
    $chapterlyAssessmentController->deleteAllChapterlyAssessment($checkAssessmentData);
    $monthlyTestController->deleteAllMonthlyTest($checkAssessmentData);
    Helper::redirect($_SERVER['PHP_SELF'] . '?deleteAssessments=true');
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

            <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
                <div class="col-sm-6 mb-3">
                    <h4 class="mb-3 mb-md-0">Students</h4>
                </div>

                <div class="col-sm-6 mb-3 d-flex justify-content-end">
                    <form action="" method="POST" onsubmit="return confirm('အကဲဖြတ်မှတ်တမ်းအားလုံးကို ဖျက်ရန် သေချာပါသလား?');">
                        <input type="hidden" name="subject_id" value="<?= $subject_id ?>">
                        <input type="hidden" name="month_no" value="<?= $month_no ?>">
                        <label for="reset">ဘာသာရပ်နှင့်လစဉ် အကဲဖြတ်မှတ်တမ်းအားလုံးကို
                            <button type="submit" name="reset" class="btn btn-danger">
                                <i class="link-icon" data-feather="trash-2"></i>
                                ဖျက်မည်
                            </button>
                        </label>
                    </form>
                </div>
            </div>



            <!-- Start Data Table -->

            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">ကျောင်းသား/သူများ </h6>
                            <div class="table-responsive">
                                <table id="teachersTable" class="table ">
                                    <thead>
                                        <tr>
                                            <th>စဉ်</th>
                                            <th>ကျောင်းဝင်နံပါတ်</th>
                                            <th>ကျောင်းသား/သူအမည်</th>
                                            <th>အသုံးပြုသူအမည်</th>
                                            <th>မိဘအမည်</th>
                                            <th>မွေးသက္ကရာဇ်</th>
                                            <th>အုပ်ထိန်းသူ</th>
                                            <th>အုပ်ထိန်းသူ၏အလုပ်အကိုင်</th>
                                            <th>ဖုန်း/နေရပ်လိပ်စာ</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $count = 1; ?>
                                        <?php foreach ($students as $student): ?>
                                            <tr>
                                                <td><?= $count ?></td>
                                                <td><?= htmlspecialchars($student['enrollment_no']) ?></td>
                                                <td><?= htmlspecialchars($student['name_mm']) ?></td>
                                                <td><?= htmlspecialchars($student['username']) ?></td>
                                                <td><?= htmlspecialchars($student['father_name']) ?> <br>
                                                    <?= htmlspecialchars($student['mother_name']) ?> </td>
                                                <td><?= htmlspecialchars($student['dob']) ?></td>
                                                <td><?= htmlspecialchars($student['guardian']) ?></td>
                                                <td><?= htmlspecialchars($student['parent_job']) ?></td>
                                                <td><?= htmlspecialchars($student['phone']) ?> <br>
                                                    <?= htmlspecialchars($student['address']) ?></td>
                                                <td class="d-flex align-items-center">
                                                    <!-- </button> -->
                                                    <a class=""
                                                        href="edit-student.php?id=<?= htmlspecialchars($student['id']) ?>"><i
                                                            data-feather="edit-2" class="icon-sm me-2"></i></a>
                                                    <a class="" href="javascript:;"
                                                        onclick="<?= AlertHelper::confirmDelete($student['id'], 'Do you want to delete this student?', 'view-students.php?delete=true&id='); ?>">
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