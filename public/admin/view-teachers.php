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

// Get pagination parameters from DataTables
// $start = $_GET['start'] ?? 0;
// $length = $_GET['length'] ?? 10;
// $search = $_GET['search']['value'] ?? '';
$teachers = $teacherController->getAllTeachers();
// $teachers = $teacherController->getFilteredRecords($start, $length, $search);


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
                                            <th>ဖုန်း</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $count = 1; ?>
                                        <?php foreach ($teachers as $teacher) : ?>
                                            <tr>
                                                <td><?= $count ?></td>
                                                <td><?= htmlspecialchars($teacher['name']) ?></td>
                                                <td><?= htmlspecialchars($teacher['username']) ?></td>
                                                <td><?= htmlspecialchars($teacher['phone']) ?></td>
                                                <td><span class="badge <?= $teacher['status'] == 'active' ? 'bg-success' : 'bg-danger' ?> "><?= htmlspecialchars($teacher['status']) ?></span></td>
                                                <td class="d-flex align-items-center">
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editModal"
                                                        data-id="<?= $teacher['id'] ?>"
                                                        data-name="<?= htmlspecialchars($teacher['name']) ?>"
                                                        data-phone="<?= htmlspecialchars($teacher['phone']) ?>"
                                                        data-password="<?= htmlspecialchars($teacher['password']) ?>"
                                                        data-status="<?= htmlspecialchars($teacher['status']) ?>">
                                                        <a class="" href="javascript:;"><i data-feather="edit-2" class="icon-sm me-2"></i></a>
                                                    </button>
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

            <!-- Start Edit Model -->
            <!-- Modal -->
            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Edit Teacher's Data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                        </div>
                        <div class="modal-body">

                            <form action="" method="POST">
                                <div class="row">
                                    <input type="hidden" name="id" id="modal-teacher-id">

                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Name</label>
                                            <input type="text" name="name" class="form-control" placeholder="Enter name" id="modal-teacher-name">
                                        </div>
                                    </div><!-- Col -->
                                    <div class="col-sm-6">
                                        <label class="form-label">Status</label>
                                        <select class="form-select" name="status" id="modal-teacher-status">
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                        </select>
                                    </div><!-- Col -->
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Phone</label>
                                            <input type="tel" name="phone" class="form-control" placeholder="Enter phone number" id="modal-teacher-phone" pattern="[0-9]{2}[0-9]{9}">
                                        </div>
                                    </div><!-- Col -->
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <input type="text" name="password" class="form-control" autocomplete="off" placeholder="Password" id="modal-teacher-password">
                                        </div>
                                    </div><!-- Col -->
                                </div><!-- Row -->
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
        const teacherPhone = button.getAttribute('data-phone');
        const teacherPassword = button.getAttribute('data-password');
        const teacherStatus = button.getAttribute('data-status');

        // Populate the modal inputs
        document.getElementById('modal-teacher-id').value = teacherId;
        document.getElementById('modal-teacher-name').value = teacherName;
        document.getElementById('modal-teacher-phone').value = teacherPhone;
        document.getElementById('modal-teacher-password').value = teacherPassword;
        document.getElementById('modal-teacher-status').value = teacherStatus.toLowerCase(); // Set the chosen status

    });
</script>
<?php
include('../components/script.php');
?>