<?php

require '../../vendor/autoload.php';
include('../components/header.php');

use app\controllers\AdminAuthController;
use app\controllers\ClassController;
use app\controllers\TeacherController;
use core\helpers\AlertHelper;


$adminAuthController = new AdminAuthController();
$teacherController = new TeacherController();
$classController = new ClassController();

if (!$adminAuthController->isAuthenticated()) {
    header("Location:login.php");
    exit();
}

$teachers = $teacherController->getAllTeachersClass();
$classes = $classController->getAllClasses();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update-btn'])) {
    $teacherController->updateTeacherClassById($_POST['id'], $_POST['class_id']);
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
                    <h4 class="mb-3 mb-md-0">အတန်းများသတ်မှတ်ရန်</h4>
                </div>
            </div>

            <!-- Start Data Table -->

            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="teachersTable" class="table ">
                                    <thead>
                                        <tr>
                                            <th>စဉ်</th>
                                            <th>အမည်</th>
                                            <th>သင်ကြားရမည့်အတန်း</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $count = 1; ?>
                                        <?php foreach ($teachers as $teacher): ?>
                                            <?php
                                            $teacherId = $teacher['id'];
                                            $teacherClassData = $teacherController->getTeacherClassNameById($teacherId);
                                            ?>

                                            <tr>
                                                <td><?= $count ?></td>
                                                <td><?= htmlspecialchars($teacher['name_mm']) ?></td>
                                                <td><?= is_null($teacher['class_id']) ? 'အတန်းမသတ်မှတ်ရသေးပါ။' : $teacherClassData->class_name ?>
                                                </td>
                                                <td class="d-flex align-items-center">
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn" data-bs-toggle="modal"
                                                        data-bs-target="#editModal" data-id="<?= $teacher['id'] ?>"
                                                        data-class-id="<?= $teacher['class_id'] ?>"
                                                        data-name="<?= htmlspecialchars($teacher['name_mm']) ?>"> <a
                                                            class="" href="javascript:;"><i data-feather="edit-2"
                                                                class="icon-sm me-2"></i></a>
                                                    </button>

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

            <!-- Start Edit Model -->
            <!-- Modal -->
            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">အတန်းသတ်မှတ်ခြင်း</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="btn-close"></button>
                        </div>
                        <div class="modal-body">

                            <form action="" method="POST">
                                <div class="row">
                                    <input type="hidden" name="id" id="modal-teacher-id">

                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">အမည်</label>
                                            <input type="text" name="name" class="form-control" id="modal-teacher-name"
                                                readonly>
                                        </div>
                                    </div><!-- Col -->
                                    <div class="col-sm-6">
                                        <label class="form-label">အတန်း</label>
                                        <select class="form-select" name="class_id" id="modal-teacher-class">
                                            <?php foreach ($classes as $class): ?>
                                                <option value="<?= $class['id'] ?>"><?= $class['class_name_mm'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div><!-- Col -->
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="update-btn" class="btn btn-primary submit">Save changes</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Edit Model -->

        </div>
    </div>
</body>
<script>
    const editModal = document.getElementById('editModal');
    editModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget; // Button that triggered the modal
        const teacherId = button.getAttribute('data-id');
        const teacherName = button.getAttribute('data-name');
        const teacherClass = button.getAttribute('data-class-id');

        // Populate the modal inputs
        document.getElementById('modal-teacher-id').value = teacherId;
        document.getElementById('modal-teacher-name').value = teacherName;
        document.getElementById('modal-teacher-class').value = teacherClass; // Set the chosen status

        console.log(teacherClass)

    });
</script>
<?php
include('../components/script.php');
?>