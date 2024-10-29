<?php

require '../../vendor/autoload.php';
include('../components/header.php');

use app\controllers\StudentController;
use core\helpers\AlertHelper;
use app\controllers\AdminAuthController;

$adminController = new AdminAuthController();
$studentController = new StudentController();
if (!$adminController->isAuthenticated()) {
    header("Location:login.php");
    exit();
}

$class_id = $_GET['class_id'] ?? 0;
$students = $studentController->getStudentsByClassId($class_id); // get all students by class id
if (empty($students)) {
    $_SESSION['error'] = "ကျောင်းသား/သူများ ဦးစွာထည့်သွင်းပါ။";
    echo "<script>
        alert('ကျောင်းသား/သူများ မထည့်သွင်းရသေးပါ။');
        window.location.href = 'students-result.php';
    </script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['class_id'])) {
    $class_id = $_POST['class_id'];
    header("Location: view-students.php?class_id=$class_id");
    exit;
}
?>


<style>
    tr:hover {
        cursor: pointer;
        text-decoration: underline;
        color: #007bff;
    }
</style>

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
                    <h4 class="mb-3 mb-md-0">ကျောင်းသား/သူများ၏ QCPR စစ်ဆေးကြည့်ရှုရန်</h4>
                </div>

                <div class="col-sm-6">
                    <form action="" method="GET" class="d-flex justify-content-end">

                        <div class="d-flex align-items-center gap-2">

                            <select class="form-select" name="class_id" id="class_id" onchange="this.form.submit()">
                                <option value="0" <?php echo ($class_id == 0) ? 'selected' : ''; ?>>သူငယ်တန်း</option>
                                <option value="1" <?php echo ($class_id == 1) ? 'selected' : ''; ?>>ပထမတန်း</option>
                                <option value="2" <?php echo ($class_id == 2) ? 'selected' : ''; ?>>ဒုတိယတန်း</option>
                                <option value="3" <?php echo ($class_id == 3) ? 'selected' : ''; ?>>တတိယတန်း</option>
                                <option value="4" <?php echo ($class_id == 4) ? 'selected' : ''; ?>>စတုတ္ထတန်း</option>
                                <option value="5" <?php echo ($class_id == 5) ? 'selected' : ''; ?>>ပဉ္စမတန်း</option>
                            </select>
                    </form>
                </div>
            </div>

        </div>

        <!-- Start Data Table -->

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <!-- <h6 class="card-title">ကျောင်းသား/သူများ </h6> -->
                        <div class="table-responsive  table-hover">
                            <table id="teachersTable" class="table ">
                                <thead>
                                    <tr>
                                        <th>စဉ်</th>
                                        <th>ကျောင်းဝင်နံပါတ်</th>
                                        <th>ကျောင်းသား/သူအမည်</th>
                                        <th>မိဘအမည်</th>
                                        <th>မွေးသက္ကရာဇ်</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $count = 1; ?>
                                    <?php foreach ($students as $student): ?>
                                        <tr onclick="window.location.href='student-result.php?id=<?= htmlspecialchars($student['id']) ?>&class_id=<?= htmlspecialchars($class_id) ?>'">
                                            <td><?= $count ?></td>
                                            <td><?= htmlspecialchars($student['enrollment_no']) ?></td>
                                            <td><?= htmlspecialchars($student['name_mm']) ?></td>
                                            <td><?= htmlspecialchars($student['father_name']) ?> <br>
                                                <?= htmlspecialchars($student['mother_name']) ?> </td>
                                            <td><?= htmlspecialchars($student['dob']) ?></td>

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