<?php

require '../../vendor/autoload.php';
include('../components/header.php');

use app\controllers\TeacherController;
use app\controllers\StudentController;
use app\controllers\G0AssessmentController;
use core\helpers\AlertHelper;

// Redirect to login page if not authenticated
$teacherController = new TeacherController();

if (!$teacherController->isAuthenticated()) {
    header("Location:login.php");
    exit();
}

$id = $_GET["id"]; // student id
$studentController = new StudentController();
$g0AssessmentController = new G0AssessmentController();

$student = $studentController->getStudentById($id);
$g0AssessmentController->createG0Assessment($student->id); // create assessment for all subjects and subject results with null mark values

$g0Assessment = $g0AssessmentController->getG0AssessmentByStudentId($student->id); // get assessment for the student
$subjects = $g0AssessmentController->getAllG0Subjects();
$subjectResults = $g0AssessmentController->getG0SubjectResults();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_btn'])) {
    // var_dump($_POST);
    $updateResult = $g0AssessmentController->updateG0Assessment($_POST);
    if ($updateResult) {
        // Success message
        $successMessage = "အချက်အလက်များ အောင်မြင်စွာ သိမ်းဆည်းပြီးပါပြီ။";
    } else {
        // Error message
        $errorMessage = "အချက်အလက်များ သိမ်းဆည်းရာတွင် အမှားအယွင်း ဖြစ်ပွားခဲ့ပါသည်။";
    }
    // Redirect to the same page to avoid form resubmission
    header("Location: " . $_SERVER['PHP_SELF'] . "?id=" . $_POST['id'] . "&success=" . ($updateResult ? '1' : '0'));
    exit();
}

$g0Assessment = $g0AssessmentController->getG0AssessmentByStudentId($student->id);

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
                <h4 class="mb-3 mb-md-0">သင်ယူမှုရလဒ်မှတ်တမ်း</h4>
            </div>

            <div class="row">
                <div class="mt-3 col-lg grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <!-- Start Form -->
                            <form id="assessmentForm" method="POST" action="">
                                <div class=" d-flex justify-content-between">
                                    <div class="">
                                        <h4 class="card-title">ကျောင်းသူ/သားအမည်: <span class="text-primary"><?= $student->name_mm ?></span></h4>
                                        <h4 class="card-title">အဘအမည်: <span class="text-primary"><?= $student->father_name ?></span></h4>
                                        <h4 class="card-title">မွေးသက္ကရာဇ်: <span class="text-primary"><?= $student->dob ?></span></h4>
                                    </div>


                                    <?php
                                    // Display success or error message if exists
                                    if (isset($_GET['success'])) {
                                        if ($_GET['success'] == '1') {
                                            echo "<div class='alert d-flex align-items-center alert-success alert-dismissible fade show' role='alert'>
                                                        အချက်အလက်များ အောင်မြင်စွာ သိမ်းဆည်းပြီးပါပြီ။
                                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='btn-close'></button></div>";
                                        } else {
                                            echo "<div class='alert d-flex align-items-center alert-warning alert-dismissible fade show' role='alert'>
                                            အချက်အလက်များ သိမ်းဆည်းရာတွင် အမှားအယွင်း ဖြစ်ပွားခဲ့ပါသည်။
                                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='btn-close'></button></div>";
                                        }
                                    }
                                    ?>
                                    <div class="">
                                        <input name="submit_btn" class="btn btn-primary" type="submit" value="သိမ်းမည်">
                                    </div>
                                </div>
                                <input type="hidden" name="id" value="<?= $student->id ?>">
                                <!-- Start Data Table -->
                                <div class="table-responsive">
                                    <table id="studentsTable" class="table assessment-table">
                                        <thead>
                                            <tr>
                                                <th class="subject-no">စဉ်</th>
                                                <th class="subject-name">သင်ယူမှုနယ်ပယ်</th>
                                                <th class="result-name">သင်ယူမှုရလဒ်</th>
                                                <th class="mark">ပထမအကြိမ်</th>
                                                <th class="mark">ဒုတိယအကြိမ်</th>
                                                <th class="mark">တတိယအကြိမ်</th>
                                                <th class="mark">စတုတ္ထအကြိမ်</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($subjects as $index => $subject): ?>
                                                <?php $subjectResults = $g0AssessmentController->getG0SubjectResultsBySubjectId($subject['id']); ?>
                                                <?php $bgClass = 'subject-bg-' . (($index % 5) + 1); ?>
                                                <tr class="<?= $bgClass ?>">
                                                    <td class="subject-no" rowspan="<?= count($subjectResults) ?>"><?= $subject['subject_no'] ?></td>
                                                    <td class="subject-name" rowspan="<?= count($subjectResults) ?>"><?= $subject['subject_name'] ?></td>
                                                    <?php $first_row = true; ?>
                                                    <?php foreach ($subjectResults as $subjectResult): ?>
                                                        <?php if (!$first_row): ?>
                                                </tr>
                                                <tr class="<?= $bgClass ?>">
                                                <?php endif; ?>
                                                <td class="result-name">
                                                    <?= $subjectResult['result_name'] ?>
                                                </td>
                                                <?php for ($i = 1; $i <= 4; $i++): ?>
                                                    <td class="mark">
                                                        <select name="mark_<?= $i ?>[<?= $subject['id'] ?>][<?= $subjectResult['id'] ?>]" class="form-control">
                                                            <option value="">ရွေးချယ်ပါ</option>
                                                            <?php for ($j = 1; $j <= 4; $j++): ?>
                                                                <option value="<?= $j ?>" <?= (isset($g0Assessment[$subject['id']][$subjectResult['id']]["mark_$i"]) && $g0Assessment[$subject['id']][$subjectResult['id']]["mark_$i"] == $j) ? 'selected' : '' ?>>
                                                                    <?= $j ?>
                                                                </option>
                                                            <?php endfor; ?>
                                                        </select>
                                                    </td>
                                                <?php endfor; ?>
                                                <?php $first_row = false; ?>
                                            <?php endforeach; ?>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
            <!-- End Form -->
        </div>
    </div>
    </div>
    </div>

</body>

<!--  JavaScript -->
<?php
include('../components/script.php');
?>
<style>
    .assessment-table {
        width: 100%;
        table-layout: fixed;
    }

    .assessment-table th,
    .assessment-table td {
        padding: 8px;
        word-wrap: break-word;
        white-space: normal;
        vertical-align: middle;
    }

    .assessment-table .subject-no {
        width: 5%;
    }

    .assessment-table .subject-name {
        width: 15%;
        white-space: normal;
    }

    .assessment-table .result-name {
        width: 20%;
        white-space: normal;
    }

    .assessment-table .mark {
        width: 15%;
    }

    .assessment-table select.form-control {
        width: 100%;
    }

    .subject-bg-1 {
        background-color: #f0f8ff;
    }

    .subject-bg-2 {
        background-color: #fff0f5;
    }

    .subject-bg-3 {
        background-color: #f0fff0;
    }

    .subject-bg-4 {
        background-color: #fff5e6;
    }

    .subject-bg-5 {
        background-color: #f5f5f5;
    }
</style>

<!-- Table HTML code remains the same as before -->