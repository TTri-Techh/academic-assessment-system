<?php

require '../../vendor/autoload.php';
include('../components/header.php');

use app\controllers\TeacherController;
use app\controllers\StudentController;
use app\controllers\SubjectController;
use app\controllers\MonthlyTestController;
use core\helpers\Helper;

$teacherController = new TeacherController();
$studentController = new StudentController();
$subjectController = new SubjectController();
$monthlyTestController = new MonthlyTestController();

// Redirect to login page if not authenticated
if (!$teacherController->isAuthenticated()) {
    Helper::redirect("login.php");
}

$students = $studentController->getStudentsByClassId($_SESSION['class_id']); // get all students by class id
$month_no = $_GET['month_no'] ?? 1;
if (empty($students)) {
    $_SESSION['error'] = "ကျောင်းသား/သူများ ဦးစွာထည့်သွင်းပါ။";
    echo "<script>
        alert('ကျောင်းသား/သူများ ဦးစွာထည့်သွင်းပါ။');
        window.location.href = 'register-students.php';
    </script>";
    exit;
}

$checkAssessmentData = [
    'class_id' => $_SESSION['class_id'],
    'month_no' => $month_no,
    'year' => date('Y')
];
// check if assessment is already created
$checkAssessment = $monthlyTestController->checkMonthlyTestIsCreated($checkAssessmentData);
if ($checkAssessment) {
    $allAssessment = $monthlyTestController->getAllMonthlyTest($checkAssessmentData);
} else {
    // Prepare data array for all students
    $assessmentData = [];
    foreach ($students as $student) {
        $assessmentData[] = [
            'student_id' => $student['id'],
            'class_id' => $_SESSION['class_id'],
            'teacher_id' => $_SESSION['teacher_id'],
            'month_no' => $month_no,
            'year' => date('Y')
        ];
    }

    // Bulk insert all assessments in one query
    $monthlyTestController->createMonthlyTest($assessmentData);

    // Get the newly created assessments
    $allAssessment = $monthlyTestController->getAllMonthlyTest($checkAssessmentData);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_btn'])) {
    $updateSuccess = true;

    // Update assessments
    if (isset($_POST['assessment']) && is_array($_POST['assessment'])) {
        foreach ($_POST['assessment'] as $assessmentId => $data) {
            $updateData = [
                'id' => $data['id'],
                'myanmar_mark' => $data['myanmar_mark'],
                'myanmar_grade' => $data['myanmar_grade'],
                'english_mark' => $data['english_mark'],
                'english_grade' => $data['english_grade'],
                'math_mark' => $data['math_mark'],
                'math_grade' => $data['math_grade'],
                'science_mark' => $data['science_mark'],
                'science_grade' => $data['science_grade'],
                'social_mark' => $data['social_mark'],
                'social_grade' => $data['social_grade'],
                'total_mark' => $data['total_mark'],
                'total_grade' => $data['total_grade'],
                'result' => $data['result']
            ];

            $result = $monthlyTestController->updateMonthlyTest($updateData);
            if (!$result) {
                $updateSuccess = false;
                break;
            }
        }
    }

    // Redirect with success or error message
    $redirectUrl = $_SERVER['PHP_SELF'] . "?month_no=" . $month_no;
    $redirectUrl .= $updateSuccess ? "&success=1" : "&success=0";
    Helper::redirect($redirectUrl);
}
// reset assessment
if (isset($_POST['reset'])) {
    $monthlyTestController->deleteMonthlyTest($checkAssessmentData);
    Helper::redirect($_SERVER['PHP_SELF'] . "?month_no=" . $month_no);
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
            <!-- Month Selection Form -->
            <div class="row justify-content-between">
                <div class="col-sm-4">
                    <h4 class="mb-3 mb-md-0">လစဉ်ဘာသာစုံရမှတ်စာရင်း</h4>
                </div>
                <div class="col-sm-4 mb-3 d-flex justify-content-end">
                    <form action="" method="POST" onsubmit="return confirm('ဘာသာစုံရမှတ်အားလုံးကို ဖျက်ရန် သေချာပါသလား?');">
                        <input type="hidden" name="month_no" value="<?= $month_no ?>">
                        <button type="submit" name="reset" class="btn btn-danger">
                            <i class="link-icon" data-feather="trash-2"></i>
                            ရမှတ်အားလုံးကို ဖျက်မည်
                        </button>
                    </form>
                </div>

                <div class="col-sm-4">
                    <form action="" method="GET" class="d-flex justify-content-end">
                        <div class="d-flex align-items-center gap-2">
                            <select class="form-select" name="month_no" id="month_no">
                                <option value="1" <?php echo ($month_no == 1) ? 'selected' : ''; ?>>June, July</option>
                                <option value="2" <?php echo ($month_no == 2) ? 'selected' : ''; ?>>August, September</option>
                                <option value="3" <?php echo ($month_no == 3) ? 'selected' : ''; ?>>October,November</option>
                                <option value="4" <?php echo ($month_no == 4) ? 'selected' : ''; ?>>December,January</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Assessment Form -->
            <div class="row">
                <div class="mt-3 col-lg grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <form id="assessmentForm" method="POST" action="">
                                <!-- Success/Error Messages -->
                                <div class="d-flex justify-content-between mb-3">
                                    <div>
                                        <?php if (isset($_GET['success'])): ?>
                                            <?php if ($_GET['success'] == '1'): ?>
                                                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                                    အချက်အလက်များ အောင်မြင်စွာ သိမ်းဆည်းပြီးပါပြီ။
                                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='btn-close'></button>
                                                </div>
                                            <?php else: ?>
                                                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                                                    အချက်အလက်များ သိမ်းဆည်းရာတွင် အမှားအယွင်း ဖြစ်ပွားခဲ့ပါသည်။
                                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='btn-close'></button>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                    <div>
                                        <input name="submit_btn" class="btn btn-primary" type="submit" value="သိမ်းမည်">
                                    </div>
                                </div>
                                <!-- Student Assessment Table -->
                                <div class="table-responsive">
                                    <table id="studentsTable" class="table assessment-table">
                                        <thead>
                                            <tr>
                                                <th>စဉ်</th>
                                                <th>ကျောင်းဝင်နံပါတ်</th>
                                                <th>ကျောင်းသားအမည်</th>
                                                <th>အဘအမည်</th>
                                                <th>မြန်မာ</th>
                                                <th>အင်္ဂလိပ်</th>
                                                <th>သင်္ချာ</th>
                                                <th>သိပ္ပံ</th>
                                                <th>လူမှုရေး</th>
                                                <th>စုစုပေါင်း</th>
                                                <th>အဆင့်</th>
                                                <th>အောင်/ရှုံး</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($allAssessment as $assessment): ?>
                                                <?php $i = isset($i) ? $i + 1 : 1; ?>
                                                <tr>
                                                    <td><?= $i ?></td>
                                                    <td>
                                                        <?= $assessment['enrollment_no'] ?>
                                                        <input type="hidden"
                                                            name="assessment[<?= $assessment['id'] ?>][id]"
                                                            value="<?= $assessment['id'] ?>">
                                                    </td>
                                                    <td>
                                                        <?= $assessment['student_name'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $assessment['father_name'] ?>
                                                    </td>
                                                    <td>
                                                        <p style="display: none;"><?= $assessment['myanmar_mark'] ?></p>
                                                        <input type="number" max="100" min="0" name="assessment[<?= $assessment['id'] ?>][myanmar_mark]" class="form-control" value="<?= $assessment['myanmar_mark'] ?>">
                                                        <input type="text" name="assessment[<?= $assessment['id'] ?>][myanmar_grade]" class="form-control" value="<?= $assessment['myanmar_grade'] ?>" readonly>
                                                    </td>
                                                    <td>
                                                        <p style="display: none;"><?= $assessment['english_mark'] ?></p>
                                                        <input type="number" max="100" min="0" name="assessment[<?= $assessment['id'] ?>][english_mark]" class="form-control" value="<?= $assessment['english_mark'] ?>">
                                                        <input type="text" name="assessment[<?= $assessment['id'] ?>][english_grade]" class="form-control" value="<?= $assessment['english_grade'] ?>" readonly>
                                                    </td>
                                                    <td>
                                                        <p style="display: none;"><?= $assessment['math_mark'] ?></p>
                                                        <input type="number" max="100" min="0" name="assessment[<?= $assessment['id'] ?>][math_mark]" class="form-control" value="<?= $assessment['math_mark'] ?>">
                                                        <input type="text" name="assessment[<?= $assessment['id'] ?>][math_grade]" class="form-control" value="<?= $assessment['math_grade'] ?>" readonly>
                                                    </td>
                                                    <td>
                                                        <p style="display: none;"><?= $assessment['science_mark'] ?></p>
                                                        <input type="number" max="100" min="0" name="assessment[<?= $assessment['id'] ?>][science_mark]" class="form-control" value="<?= $assessment['science_mark'] ?>">
                                                        <input type="text" name="assessment[<?= $assessment['id'] ?>][science_grade]" class="form-control" value="<?= $assessment['science_grade'] ?>" readonly>
                                                    </td>
                                                    <td>
                                                        <p style="display: none;"><?= $assessment['social_mark'] ?></p>
                                                        <input type="number" max="100" min="0" name="assessment[<?= $assessment['id'] ?>][social_mark]" class="form-control" value="<?= $assessment['social_mark'] ?>">
                                                        <input type="text" name="assessment[<?= $assessment['id'] ?>][social_grade]" class="form-control" value="<?= $assessment['social_grade'] ?>" readonly>
                                                    </td>
                                                    <td>
                                                        <p style="display: none;"><?= $assessment['total_mark'] ?></p>
                                                        <input type="number" name="assessment[<?= $assessment['id'] ?>][total_mark]" class="form-control bg-light" style="cursor: default;" value="<?= $assessment['total_mark'] ?>" readonly>
                                                    </td>
                                                    <td>
                                                        <p style="display: none;"><?= $assessment['total_grade'] ?></p>
                                                        <input type="text" name="assessment[<?= $assessment['id'] ?>][total_grade]" class="form-control" value="<?= $assessment['total_grade'] ?>" readonly>
                                                    </td>
                                                    <td>

                                                        <p style="display: none;"><?=
                                                                                    // get first letter of result
                                                                                    substr($assessment['result'], 0, 1) ?></p>
                                                        <input type="text" name="assessment[<?= $assessment['id'] ?>][result]" class="form-control result-column" value="<?= $assessment['result'] ?>" readonly>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div> <!-- main-wrapper end -->

    <?php include('../components/script.php'); ?>
    <script src="../assets/js/monthly-test-grade.js"></script>

    <script>
        document.getElementById('month_no').addEventListener('change', function() {
            const urlParams = new URLSearchParams(window.location.search);
            // Remove success parameter if it exists
            urlParams.delete('success');
            // Update month_no parameter
            urlParams.set('month_no', this.value);
            window.location.href = window.location.pathname + '?' + urlParams.toString();
        });

        // Auto hide success message after 3 seconds
        setTimeout(function() {
            const alert = document.querySelector('.alert');
            if (alert) {
                alert.remove();
                const urlParams = new URLSearchParams(window.location.search);
                // Remove success parameter if it exists
                urlParams.delete('success');
                window.location.href = window.location.pathname + '?' + urlParams.toString();
            }
        }, 1000);
    </script>
    <style>
        input:not([type="submit"]) {
            text-align: center;
            width: 60px;
        }

        .grade-a,
        .pass {
            background-color: #4CAF50 !important;
            /* စိမ်းနုရောင်သစ် - ကြည်လင်တဲ့အစိမ်းရောင် */
            color: white;
        }

        .grade-b {
            background-color: #2196F3 !important;
            /* ပြာရောင်သစ် - Microsoft Blue နီးပါး */
            color: white;
        }

        .grade-c {
            background-color: #FF9800 !important;
            /* လိမ္မော်ရောင်သစ် - Material Design Orange */
            color: white;
        }

        .grade-d,
        .fail {
            background-color: #f44336 !important;
            /* အနီရောင်သစ် - Material Design Red */
            color: white;
        }

        /* Hide arrows in Chrome, Safari, Edge, and Opera */
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Hide arrows in Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
</body>