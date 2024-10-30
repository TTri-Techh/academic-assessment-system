<?php

require '../../vendor/autoload.php';
include('../components/header.php');

use app\controllers\StudentController;
use app\controllers\AdminAuthController;
use app\controllers\G0AssessmentController;
use app\controllers\MonthlyAssessmentController;
use app\controllers\MonthlyTestController;
use core\helpers\Helper;

$adminController = new AdminAuthController();
$studentController = new StudentController();
$monthlyAssessmentController = new MonthlyAssessmentController();
$monthlyTestController = new MonthlyTestController();
$g0AssessmentController = new G0AssessmentController();
if (!$adminController->isAuthenticated()) {
    header("Location:login.php");
    exit();
}

$id = $_GET['id'] ?? 0;
$student = $studentController->getStudentById($id); // get all students by class id
$className = $studentController->getStudentClassNameById($id);

// get g0 assessment by student id
if ($student->class_id == 0) {
    $g0AssessmentController->createG0Assessment($student->id); // create assessment for all subjects and subject results with null mark values

    $g0Assessment = $g0AssessmentController->getG0AssessmentByStudentId($student->id); // get assessment for the student
    $subjects = $g0AssessmentController->getAllG0Subjects();
    $subjectResults = $g0AssessmentController->getG0SubjectResults();
}

// get monthly assessment by student id and class id for grade 1, 2, 3
if ($student->class_id == 1 || $student->class_id == 2 || $student->class_id == 3) {
    $monthlyAssessment = $monthlyAssessmentController->getMonthlyAssessmentByStudentId($student->id, $student->class_id);
}
// get monthly test by student id and class id for grade 4, 5, 6
if ($student->class_id == 4 || $student->class_id == 5) {
    $monthlyTest = $monthlyTestController->getMonthlyTestByStudentId($student->id, $student->class_id);
}

?>

<head>
    <?php if ($student->class_id == 0) : ?>
        <link rel="stylesheet" href="../../assets/css/demo1/custom/kg-table.css">
    <?php endif; ?>
    <style>
        tr:hover {
            cursor: pointer;
            color: #007bff;
        }
    </style>
</head>

<body>

    <div class="main-wrapper">

        <!-- Sidebar & Navbar -->
        <?php
        include('../components/admin_sidebar.php');

        include('../components/admin_navbar.php');
        ?>

        <div class="page-content">

            <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
                <div class="col-sm-6">
                    <?php if ($student->class_id == 0) : ?>
                        <h4 class="mb-3 mb-md-0"><?= $student->name_mm ?> ၏ သင်ယူမှုရလဒ်</h4>
                    <?php else : ?>
                        <h4 class="mb-3 mb-md-0"><?= $student->name_mm ?> ၏ QCPR</h4>
                    <?php endif; ?>
                </div>

            </div>



            <!-- start show qcpr -->
            <div class="container position-relative">
                <div class="row">
                    <div class="col-lg-12 card shadow-sm border-0 p-4 rounded-3 main-banner">
                        <!-- Add blur wrapper -->
                        <div class="blur-wrapper " id="qcprContent">
                            <div class="col-lg-3 mb-3 bg-white p-3 rounded-3">
                                <p><b class="text-dark">အမည်</b> : <?= $student->name_mm ?></p>
                                <p><b class="text-dark">အတန်း</b> : <?= $className->class_name ?></p>
                            </div>
                            <?php if ($student->class_id == 0) : ?>
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
                                                        <?php
                                                            $mark = isset($g0Assessment[$subject['id']][$subjectResult['id']]["mark_$i"])
                                                                ? $g0Assessment[$subject['id']][$subjectResult['id']]["mark_$i"]
                                                                : '';
                                                            echo $mark ?: '-';
                                                        ?>
                                                    </td>
                                                <?php endfor; ?>
                                                <?php $first_row = false; ?>
                                            <?php endforeach; ?>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endif; ?>
                            <?php if ($student->class_id == 1 || $student->class_id == 2 || $student->class_id == 3) : ?>
                                <!-- table start for Grade 1, 2, 3 -->
                                <table class="table table-bordered table-hover text-center">
                                    <thead>
                                        <tr>
                                            <th>ဘာသာရပ်</th>
                                            <th>အခန်းဆုံးတတ်မြောက်မှု <br> စစ်ဆေးခြင်း <br> (Chapter End Test) </th>
                                            <th>နှစ်ဝက်ဆုံးတတ်မြောက်မှု <br> စစ်ဆေးခြင်း <br> (Midterm Test) </th>
                                            <th>အခန်းဆုံးတတ်မြောက်မှု <br> စစ်ဆေးခြင်း <br> (Chapter End Test) </th>
                                            <th>နှစ်ဆုံးတတ်မြောက်မှု <br> စစ်ဆေးခြင်း <br> (Final End Test) </th>
                                            <th>ပျမ်းမျှအဆင့်</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>မြန်မာစာ</td>
                                            <td><?= Helper::getLowerGradeBySubjectId($monthlyAssessment, 1, 1) ?></td>
                                            <td><?= Helper::getLowerGradeBySubjectId($monthlyAssessment, 1, 2) ?></td>
                                            <td><?= Helper::getLowerGradeBySubjectId($monthlyAssessment, 1, 3) ?></td>
                                            <td><?= Helper::getLowerGradeBySubjectId($monthlyAssessment, 1, 4) ?></td>
                                            <td><?= Helper::calculateLowerAverageGrade($monthlyAssessment, 1) ?></td>
                                        </tr>
                                        <tr>
                                            <td>အင်္ဂလိပ်စာ</td>
                                            <td><?= Helper::getLowerGradeBySubjectId($monthlyAssessment, 2, 1) ?></td>
                                            <td><?= Helper::getLowerGradeBySubjectId($monthlyAssessment, 2, 2) ?></td>
                                            <td><?= Helper::getLowerGradeBySubjectId($monthlyAssessment, 2, 3) ?></td>
                                            <td><?= Helper::getLowerGradeBySubjectId($monthlyAssessment, 2, 4) ?></td>
                                            <td><?= Helper::calculateLowerAverageGrade($monthlyAssessment, 2) ?></td>
                                        </tr>
                                        <tr>
                                            <td>သင်္ချာ</td>
                                            <td><?= Helper::getLowerGradeBySubjectId($monthlyAssessment, 3, 1) ?></td>
                                            <td><?= Helper::getLowerGradeBySubjectId($monthlyAssessment, 3, 2) ?></td>
                                            <td><?= Helper::getLowerGradeBySubjectId($monthlyAssessment, 3, 3) ?></td>
                                            <td><?= Helper::getLowerGradeBySubjectId($monthlyAssessment, 3, 4) ?></td>
                                            <td><?= Helper::calculateLowerAverageGrade($monthlyAssessment, 3) ?></td>
                                        </tr>
                                        <tr>
                                            <td>သိပ္ပံ</td>
                                            <td><?= Helper::getLowerGradeBySubjectId($monthlyAssessment, 4, 1) ?></td>
                                            <td><?= Helper::getLowerGradeBySubjectId($monthlyAssessment, 4, 2) ?></td>
                                            <td><?= Helper::getLowerGradeBySubjectId($monthlyAssessment, 4, 3) ?></td>
                                            <td><?= Helper::getLowerGradeBySubjectId($monthlyAssessment, 4, 4) ?></td>
                                            <td><?= Helper::calculateLowerAverageGrade($monthlyAssessment, 4) ?></td>
                                        </tr>
                                        <tr>
                                            <td>လူမှုရေး</td>
                                            <td><?= Helper::getLowerGradeBySubjectId($monthlyAssessment, 5, 1) ?></td>
                                            <td><?= Helper::getLowerGradeBySubjectId($monthlyAssessment, 5, 2) ?></td>
                                            <td><?= Helper::getLowerGradeBySubjectId($monthlyAssessment, 5, 3) ?></td>
                                            <td><?= Helper::getLowerGradeBySubjectId($monthlyAssessment, 5, 4) ?></td>
                                            <td><?= Helper::calculateLowerAverageGrade($monthlyAssessment, 5) ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!-- table end for Grade 1, 2, 3 -->
                            <?php endif; ?>

                            <?php if ($student->class_id == 4 || $student->class_id == 5) : ?>
                                <!-- table start for Grade 4, 5 -->
                                <table class="table table-bordered table-hover text-center">
                                    <thead>
                                        <tr>
                                            <th>ဘာသာရပ်</th>
                                            <th>အခန်းဆုံးတတ်မြောက်မှု <br> စစ်ဆေးခြင်း <br> (Chapter End Test) </th>
                                            <th>နှစ်ဝက်ဆုံးတတ်မြောက်မှု <br> စစ်ဆေးခြင်း <br> (Midterm Test) </th>
                                            <th>အခန်းဆုံးတတ်မြောက်မှု <br> စစ်ဆေးခြင်း <br> (Chapter End Test) </th>
                                            <th>နှစ်ဆုံးတတ်မြောက်မှု <br> စစ်ဆေးခြင်း <br> (Final End Test) </th>
                                            <th>ပျမ်းမျှအဆင့်</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>မြန်မာစာ</td>
                                            <td><?= Helper::getUpperGradeBySubject($monthlyTest, 'myanmar', 1) ?></td>
                                            <td><?= Helper::getUpperGradeBySubject($monthlyTest, 'myanmar', 2) ?></td>
                                            <td><?= Helper::getUpperGradeBySubject($monthlyTest, 'myanmar', 3) ?></td>
                                            <td><?= Helper::getUpperGradeBySubject($monthlyTest, 'myanmar', 4) ?></td>
                                            <td><?= Helper::calculateAverageGrade($monthlyTest, 'myanmar') ?></td>
                                        </tr>
                                        <tr>
                                            <td>အင်္ဂလိပ်စာ</td>
                                            <td><?= Helper::getUpperGradeBySubject($monthlyTest, 'english', 1) ?></td>
                                            <td><?= Helper::getUpperGradeBySubject($monthlyTest, 'english', 2) ?></td>
                                            <td><?= Helper::getUpperGradeBySubject($monthlyTest, 'english', 3) ?></td>
                                            <td><?= Helper::getUpperGradeBySubject($monthlyTest, 'english', 4) ?></td>
                                            <td><?= Helper::calculateAverageGrade($monthlyTest, 'english') ?></td>
                                        </tr>
                                        <tr>
                                            <td>သင်္ချာ</td>
                                            <td><?= Helper::getUpperGradeBySubject($monthlyTest, 'math', 1) ?></td>
                                            <td><?= Helper::getUpperGradeBySubject($monthlyTest, 'math', 2) ?></td>
                                            <td><?= Helper::getUpperGradeBySubject($monthlyTest, 'math', 3) ?></td>
                                            <td><?= Helper::getUpperGradeBySubject($monthlyTest, 'math', 4) ?></td>
                                            <td><?= Helper::calculateAverageGrade($monthlyTest, 'math') ?></td>
                                        </tr>
                                        <tr>
                                            <td>သိပ္ပံ</td>
                                            <td><?= Helper::getUpperGradeBySubject($monthlyTest, 'science', 1) ?></td>
                                            <td><?= Helper::getUpperGradeBySubject($monthlyTest, 'science', 2) ?></td>
                                            <td><?= Helper::getUpperGradeBySubject($monthlyTest, 'science', 3) ?></td>
                                            <td><?= Helper::getUpperGradeBySubject($monthlyTest, 'science', 4) ?></td>
                                            <td><?= Helper::calculateAverageGrade($monthlyTest, 'science') ?></td>
                                        </tr>
                                        <tr>
                                            <td>လူမှုရေး</td>
                                            <td><?= Helper::getUpperGradeBySubject($monthlyTest, 'social', 1) ?></td>
                                            <td><?= Helper::getUpperGradeBySubject($monthlyTest, 'social', 2) ?></td>
                                            <td><?= Helper::getUpperGradeBySubject($monthlyTest, 'social', 3) ?></td>
                                            <td><?= Helper::getUpperGradeBySubject($monthlyTest, 'social', 4) ?></td>
                                            <td><?= Helper::calculateAverageGrade($monthlyTest, 'social') ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!-- table end for Grade 4, 5 -->
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end show qcpr -->



        </div>

    </div>
    </div>
</body>
<?php
include('../components/script.php');
?>