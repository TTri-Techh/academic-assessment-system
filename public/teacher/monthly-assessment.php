<?php

require '../../vendor/autoload.php';
include('../components/header.php');

use app\controllers\TeacherController;
use app\controllers\StudentController;
use app\controllers\SubjectController;
use app\controllers\MonthlyAssessmentController;
use core\helpers\Helper;

$teacherController = new TeacherController();
$studentController = new StudentController();
$subjectController = new SubjectController();
$monthlyAssessmentController = new MonthlyAssessmentController();

// Redirect to login page if not authenticated
if (!$teacherController->isAuthenticated()) {
    Helper::redirect("login.php");
}

$subject_id = $_GET["subject_id"]; // subject id
$students = $studentController->getStudentsByClassId($_SESSION['class_id']); // get all students by class id
$subjectName = $subjectController->getSubjectNameById($subject_id);
$month_no = $_GET['month_no'] ?? 1;

$checkAssessmentData = [
    'subject_id' => $subject_id,
    'class_id' => $_SESSION['class_id'],
    'month_no' => $month_no,
    'year' => date('Y')
];
// check if assessment is already created
$checkAssessment = $monthlyAssessmentController->checkAssessmentIsCreated($checkAssessmentData);
if ($checkAssessment) {
    $allAssessment = $monthlyAssessmentController->getAllMonthlyAssessment($checkAssessmentData);
} else {
    // Prepare data array for all students
    $assessmentData = [];
    foreach ($students as $student) {
        $assessmentData[] = [
            'student_id' => $student['id'],
            'teacher_id' => $_SESSION['teacher_id'],
            'subject_id' => $subject_id,
            'class_id' => $_SESSION['class_id'],
            'month_no' => $month_no,
            'year' => date('Y')
        ];
    }

    // Bulk insert all assessments in one query
    $monthlyAssessmentController->createMonthlyAssessment($assessmentData);

    // Get the newly created assessments
    $allAssessment = $monthlyAssessmentController->getAllMonthlyAssessment($checkAssessmentData);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_btn'])) {
    $updateSuccess = true;

    // Update monthly chapter first
    if (isset($_POST['chapter'])) {
        $chapterData = [
            'subject_id' => $subject_id,
            'class_id' => $_SESSION['class_id'],
            'month_no' => $month_no,
            'year' => date('Y'),
            'chapter' => $_POST['chapter']['chapter'],
            'learning_outcomes' => $_POST['chapter']['learning_outcomes'],
            'check_points' => $_POST['chapter']['check_points']
        ];
        var_dump($chapterData);

        $result = $monthlyAssessmentController->updateMonthlyChapterByConditions($chapterData);
        if (!$result) {
            $updateSuccess = false;
        }
    }

    // Update assessments
    var_dump($_POST['assessment']);
    if ($updateSuccess && isset($_POST['assessment']) && is_array($_POST['assessment'])) {
        foreach ($_POST['assessment'] as $assessmentId => $data) {
            $updateData = [
                'id' => $data['id'],
                'mark' => $data['mark'],
                'remark' => $data['remark']
            ];

            $result = $monthlyAssessmentController->updateMonthlyAssessment($updateData);
            if (!$result) {
                $updateSuccess = false;
                break;
            }
        }
    }

    // Redirect with success or error message
    $redirectUrl = $_SERVER['PHP_SELF'] . "?subject_id=" . $subject_id . "&month_no=" . $month_no;
    $redirectUrl .= $updateSuccess ? "&success=1" : "&success=0";
    Helper::redirect($redirectUrl);
}

// Get monthly chapter data first
$monthlyChapter = $monthlyAssessmentController->getMonthlyChapter([
    'subject_id' => $subject_id,
    'class_id' => $_SESSION['class_id'],
    'month_no' => $month_no,
    'year' => date('Y')
]);

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
                <div class="col-sm-6">
                    <h4 class="mb-3 mb-md-0">လစဉ်ဘာသာရပ်အလိုက်စစ်ဆေးအကဲဖြတ်မှတ်တမ်း (<span class="text-primary"><?= $subjectName ?></span>)</h4>
                </div>

                <div class="col-sm-6">
                    <form action="" method="GET" class="d-flex justify-content-end">
                        <input type="hidden" name="subject_id" value="<?= $subject_id ?>">
                        <div class="d-flex align-items-center gap-2">
                            <select class="form-select" name="month_no" id="month_no">
                                <option value="1" <?php echo ($month_no == 1) ? 'selected' : ''; ?>>June, July</option>
                                <option value="2" <?php echo ($month_no == 2) ? 'selected' : ''; ?>>August, September</option>
                                <option value="3" <?php echo ($month_no == 3) ? 'selected' : ''; ?>>October,November</option>
                                <option value="4" <?php echo ($month_no == 4) ? 'selected' : ''; ?>>December,January</option>
                            </select>
                            <button type="submit" class="btn btn-primary">စစ်ဆေးရန်</button>
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

                                <!-- Chapter Information -->
                                <div class="table-responsive mb-4">
                                    <table class="table">
                                        <tbody>
                                            <tr style="background-color: #f0f8ff;">
                                                <th width="20%">အခန်း</th>
                                                <td>
                                                    <input type="text"
                                                        name="chapter[chapter]"
                                                        class="form-control"
                                                        value="<?= $monthlyChapter['chapter'] ?? '' ?>"
                                                        placeholder="အခန်းအမည်">
                                                    <input type="hidden"
                                                        name="chapter[id]"
                                                        value="<?= $monthlyChapter['id'] ?? '' ?>">
                                                </td>
                                            </tr>
                                            <tr style="background-color: #fff0f5;">
                                                <th width="20%">သင်ယူမှုဦးတည်ချက်များ</th>
                                                <td>
                                                    <textarea name="chapter[learning_outcomes]"
                                                        class="form-control"
                                                        placeholder="သင်ယူမှုဦးတည်ချက်များ"><?= $monthlyChapter['learning_outcomes'] ?? '' ?></textarea>
                                                </td>
                                            </tr>
                                            <tr style="background-color: #f5f5f5;">
                                                <th width="20%">စစ်ဆေးသည့်အချက်များ</th>
                                                <td>
                                                    <textarea name="chapter[check_points]"
                                                        class="form-control"
                                                        placeholder="စစ်ဆေးသည့်အချက်များ"><?= $monthlyChapter['check_points'] ?? '' ?></textarea>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Student Assessment Table -->
                                <div class="table-responsive">
                                    <table id="studentsTable" class="table assessment-table">
                                        <thead>
                                            <tr>
                                                <th class="subject-no">စဉ်</th>
                                                <th class="subject-name">ကျောင်းသားအမည်</th>
                                                <th class="result-name">တတ်မြောက်မှုအဆင့်</th>
                                                <th class="mark">မှတ်ချက်</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($allAssessment as $assessment): ?>
                                                <?php $i = isset($i) ? $i + 1 : 1; ?>
                                                <tr>
                                                    <td><?= $i ?></td>
                                                    <td>
                                                        <?= $assessment['student_name'] ?>
                                                        <input type="hidden"
                                                            name="assessment[<?= $assessment['id'] ?>][id]"
                                                            value="<?= $assessment['id'] ?>">
                                                    </td>
                                                    <td>
                                                        <select name="assessment[<?= $assessment['id'] ?>][mark]" class="form-control">
                                                            <option value="">ရွေးချယ်ပါ</option>
                                                            <option value="A" <?= ($assessment['mark'] == 'A') ? 'selected' : '' ?>>အလွန်ကောင်း</option>
                                                            <option value="S" <?= ($assessment['mark'] == 'S') ? 'selected' : '' ?>>ကောင်း</option>
                                                            <option value="E" <?= ($assessment['mark'] == 'E') ? 'selected' : '' ?>>ထပ်မံကြိုးစားရန်လို</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <textarea name="assessment[<?= $assessment['id'] ?>][remark]"
                                                            class="form-control"><?= $assessment['remark'] ?></textarea>
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

    <!-- Add this script before closing body tag -->
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
            }
        }, 3000);
    </script>

</body>

<?php include('../components/script.php'); ?>