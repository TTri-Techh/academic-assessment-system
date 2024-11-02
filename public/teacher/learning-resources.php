<?php

require '../../vendor/autoload.php';
include('../components/header.php');

use app\controllers\ResourcesController;
use app\controllers\StudentController;
use app\controllers\SubjectController;
use app\controllers\TeacherController;
use core\helpers\AlertHelper;

$teacherController = new TeacherController();
$studentController = new StudentController();
if (!$teacherController->isAuthenticated()) {
    header("Location:login.php");
    exit();
}

$subjectController = new SubjectController();
$subjects = $subjectController->getMainSubjects();

// Add this after creating $subjects
$resourceController = new ResourcesController();
$resources = $resourceController->getResourcesByTeacher($_SESSION['teacher_id']);

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

// Add this after session_start() or at the beginning of the file
if (isset($_SESSION['alert'])) {
    $alert = $_SESSION['alert'];
    AlertHelper::showAlert($alert['title'], $alert['message'], $alert['type']);
    unset($_SESSION['alert']);
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
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Upload Learning Resources</h6>
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Subject</label>
                                            <select name="subject_id" class="form-select" required>
                                                <?php
                                                foreach ($subjects as $subject) {
                                                    echo "<option value='" . $subject['id'] . "'>" . $subject['subject_name'] . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Chapter No</label>
                                            <input type="number" name="chapter_no" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Chapter Name</label>
                                            <input type="text" name="chapter_name" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Title</label>
                                            <input type="text" name="title" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Description</label>
                                            <textarea name="description" class="form-control" rows="3" required></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Files (PDF, PPT, Images)</label>
                                            <input type="file" name="files[]" class="form-control" multiple
                                                accept=".pdf,.ppt,.pptx,.jpg,.jpeg,.png" required>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" name="upload-btn" class="btn btn-primary">Upload</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Display Resources Table -->
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Learning Resources</h6>
                            <div id="studentsTable" class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Chapter</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Files</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($resources as $resource): ?>
                                            <tr>
                                                <td>
                                                    <input type="hidden" value="<?= $resource['chapter_no'] ?>?>">
                                                    <?= $resource['chapter_no'] ?> - <?= $resource['chapter_name'] ?>
                                                </td>
                                                <td><?= $resource['title'] ?></td>
                                                <td><?= $resource['description'] ?></td>
                                                <td>
                                                    <!-- Check if files is not null before decoding -->
                                                    <?php if (!empty($resource['files'])): ?>
                                                        <!-- Convert comma-separated string to array -->
                                                        <?php $files = explode(',', $resource['files']); ?>
                                                        <?php foreach ($files as $file): ?>
                                                            <?php $fileName = basename($file); ?>
                                                            <a href='/<?= $file ?>' target='_blank'><?= $fileName ?></a><br>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <a href='edit-resource.php?id=<?= $resource['id'] ?>'
                                                        class='btn btn-sm btn-primary me-1'>Edit</a>
                                                    <button onclick="deleteResource(<?= $resource['id'] ?>)"
                                                        class='btn btn-sm btn-danger'>Delete</button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<?php
include('../components/script.php');
?>

<?php
// Add file upload handling
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['upload-btn'])) {
    $uploadDir = '../storage/uploads/';
    $filesArr = [];

    // Handle file uploads
    foreach ($_FILES['files']['tmp_name'] as $key => $tmp_name) {
        $file_name = $_FILES['files']['name'][$key];
        $file_tmp = $_FILES['files']['tmp_name'][$key];
        $file_path = $uploadDir . time() . '_' . $file_name;

        if (move_uploaded_file($file_tmp, $file_path)) {
            $filesArr[] = str_replace('../', '', $file_path);
        }
    }

    // Add teacher_id to POST data
    $_POST['teacher_id'] = $_SESSION['teacher_id'];
    $_POST['class_id'] = $_SESSION['class_id'];
    $resourceController = new ResourcesController();
    $result = $resourceController->createResource($_POST, $filesArr);

    if ($result) {
        $_SESSION['alert'] = [
            'type' => 'success',
            'title' => 'Success!',
            'message' => 'Resource uploaded successfully.'
        ];
    }
    //  else {
    //     $_SESSION['alert'] = [
    //         'type' => 'error',
    //         'title' => 'Error!',
    //         'message' => 'Failed to upload resource.'
    //     ];
    // }

    echo "<script>window.location.href = 'learning-resources.php';</script>";
    exit();
}

?>

<script>
    function deleteResource(id) {
        if (confirm('Are you sure you want to delete this resource?')) {
            window.location.href = `learning-resources.php?delete=true&id=${id}`;
        }
    }
</script>

<?php
// Add this to your PHP handlers section
if (isset($_GET['delete']) && $_GET['delete'] === 'true') {
    $id = (int) $_GET['id'];
    $resourceController = new ResourcesController();
    if ($resourceController->deleteResource($id)) {
        $_SESSION['alert'] = [
            'type' => 'success',
            'title' => 'Success!',
            'message' => 'Resource deleted successfully.'
        ];
    } else {
        $_SESSION['alert'] = [
            'type' => 'error',
            'title' => 'Error!',
            'message' => 'Failed to delete resource.'
        ];
    }
    echo "<script>window.location.href = 'learning-resources.php';</script>";
    exit();
}

?>