<?php

require '../../vendor/autoload.php';
include('../components/header.php');

use app\controllers\TeacherController;
use app\controllers\StudentController;
use app\controllers\G0AssessmentController;

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

<head>
    <link rel="stylesheet" href="../../assets/css/demo1/custom/kg-table.css">
</head>

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
            <div class="card rounded-5">
                <div class="card-body">
                    <div class="card-title">
                        <p class="fw-bold text-primary">မှတ်ချက် ။ ။ သတ်မှတ်ထားသော ကာလအတွင်း ကလေးရရှိသော သင်ယူမှုရလဒ်အဆင့်ကိုရွေးပါ။ </p>
                    </div>
                    <ul type='none'>
                        <li>1. ကလေးသည် ဤသင်ယူမှုရလဒ်နှင့်ပတ်သက်၍ စတင်လေ့လာသင်ယူနေလျှင် <span class="text-primary"> အဆင့်(1) </span>ကိုရွေးပါ။</li>
                        <li>2. ကလေးသည် ဤသင်ယူမှုရလဒ်နှင့်ပတ်သက်၍ ကောင်းစွာလေ့လာသင်ယူနေလျှင် <span class="text-primary"> အဆင့်(2) </span>ကိုရွေးပါ။</li>
                        <li>3. ကလေးသည် ဤသင်ယူမှုရလဒ်နှင့်ပတ်သက်၍ လေ့လာသင်ယူရာတွင် တိုးတက်မှုရှိလျှင် <span class="text-primary"> အဆင့်(3) </span>ကိုရွေးပါ။</li>
                        <li>4. ကလေးသည် ဤသင်ယူမှုရလဒ်ကို သင်ယူပြီးမြောက်လျှင် <span class="text-primary"> အဆင့်(4) </span>ကိုရွေးပါ။</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>


    <!--  JavaScript -->
    <script>
        // Auto hide success message after 2 seconds
        setTimeout(function() {
            const alert = document.querySelector('.alert');
            if (alert) {
                alert.remove();
                const urlParams = new URLSearchParams(window.location.search);
                // Remove success parameter if it exists
                urlParams.delete('success');
                window.location.href = window.location.pathname + '?' + urlParams.toString();
            }
        }, 2000);
    </script>
</body>
<?php
include('../components/script.php');
?>