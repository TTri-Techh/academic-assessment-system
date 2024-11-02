<?php
require '../../vendor/autoload.php';
include('../components/header.php');

use app\controllers\ResourcesController;
use app\controllers\SubjectController;
use app\controllers\TeacherController;
use core\helpers\AlertHelper;

$teacherController = new TeacherController();
if (!$teacherController->isAuthenticated()) {
    header("Location:login.php");
    exit();
}

$resourceController = new ResourcesController();
$subjectController = new SubjectController();

// Get resource details
$resource_id = $_GET['id'] ?? 0;
$resource = $resourceController->getResourceById($resource_id);
$files = $resourceController->getResourceFiles($resource_id);
$subjects = $subjectController->getMainSubjects();

// Handle update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update-btn'])) {
    $uploadSuccess = true;
    $filesArr = [];

    // Handle file uploads if new files are selected
    if (!empty($_FILES['new_files']['name'][0])) {
        $uploadDir = '../storage/uploads/';

        foreach ($_FILES['new_files']['tmp_name'] as $key => $tmp_name) {
            $file_name = $_FILES['new_files']['name'][$key];
            $file_tmp = $_FILES['new_files']['tmp_name'][$key];
            $file_path = $uploadDir . time() . '_' . $file_name;

            if (move_uploaded_file($file_tmp, $file_path)) {
                $filesArr[] = str_replace('../', '', $file_path);
            } else {
                $uploadSuccess = false;
            }
        }
    }

    // Update resource details
    if ($resourceController->updateResource($_POST, $resource_id)) {
        // Add new files if any
        if (!empty($filesArr)) {
            $resourceController->addNewFiles($resource_id, $filesArr);
        }

        $_SESSION['alert'] = [
            'type' => 'success',
            'title' => 'Success!',
            'message' => 'Resource updated successfully.'
        ];

        header("Location: learning-resources.php");
        exit();
    } else {
        AlertHelper::showAlert('Error!', 'Failed to update resource.', 'error');
    }
}

// Add this near the top of the file after session_start()
if (isset($_SESSION['alert'])) {
    $alert = $_SESSION['alert'];
    AlertHelper::showAlert($alert['title'], $alert['message'], $alert['type']);
    unset($_SESSION['alert']);
}

// Add this PHP code at the top with other form handlers
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['upload-files'])) {
    $uploadDir = '../storage/uploads/';
    $filesArr = [];
    $uploadSuccess = true;

    if (!empty($_FILES['new_files']['name'][0])) {
        foreach ($_FILES['new_files']['tmp_name'] as $key => $tmp_name) {
            $file_name = $_FILES['new_files']['name'][$key];
            $file_tmp = $_FILES['new_files']['tmp_name'][$key];
            $file_path = $uploadDir . time() . '_' . $file_name;

            if (move_uploaded_file($file_tmp, $file_path)) {
                $filesArr[] = str_replace('../', '', $file_path);
            } else {
                $uploadSuccess = false;
            }
        }

        if ($uploadSuccess && !empty($filesArr)) {
            $resourceController->addNewFiles($resource_id, $filesArr);
            echo "<script>window.location.href = 'edit-resource.php?id=" . $resource_id . "';</script>";
            exit();
        }
    }
}
?>

<body>
    <div class="main-wrapper">
        <?php
        include('../components/teacher_sidebar.php');
        include('../components/teacher_navbar.php');
        ?>

        <div class="page-content">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Edit Learning Resource</h6>
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Subject</label>
                                            <select name="subject_id" class="form-select" required>
                                                <?php
                                                foreach ($subjects as $subject) {
                                                    $selected = ($subject['id'] == $resource['subject_id']) ? 'selected' : '';
                                                    echo "<option value='{$subject['id']}' {$selected}>{$subject['subject_name']}</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Chapter No</label>
                                            <input type="number" name="chapter_no" class="form-control"
                                                value="<?php echo $resource['chapter_no']; ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Chapter Name</label>
                                            <input type="text" name="chapter_name" class="form-control"
                                                value="<?php echo $resource['chapter_name']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Title</label>
                                            <input type="text" name="title" class="form-control"
                                                value="<?php echo $resource['title']; ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Description</label>
                                            <textarea name="description" class="form-control" rows="3" required><?php echo $resource['description']; ?></textarea>
                                        </div>
                                    </div>
                                </div>

                                <!-- Add this section before the existing files table -->
                                <div class="mb-3">
                                    <label class="form-label">Upload New Files (PDF, PPT, Images)</label>
                                    <input type="file" name="new_files[]" class="form-control" multiple
                                        accept=".pdf,.ppt,.pptx,.jpg,.jpeg,.png">
                                </div>

                                <!-- Existing Files Section -->
                                <div class="mb-3">
                                    <label class="form-label">Existing Files</label>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>File Name</th>
                                                    <th>File Type</th>
                                                    <th>File Size</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($files as $file):
                                                    $filePath = '../' . $file['file_path'];
                                                    $fileName = basename($file['file_path']);
                                                    $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
                                                    $fileSize = file_exists($filePath) ? round(filesize($filePath) / 1024, 2) : 0; // KB
                                                ?>
                                                    <tr>
                                                        <td>
                                                            <i class="<?php echo getFileIconClass($fileExt); ?> me-2"></i>
                                                            <?php echo $fileName; ?>
                                                        </td>
                                                        <td><?php echo strtoupper($fileExt); ?></td>
                                                        <td><?php echo $fileSize; ?> KB</td>
                                                        <td>
                                                            <a href="/<?php echo $file['file_path']; ?>"
                                                                target="_blank"
                                                                class="btn btn-sm btn-info me-1">
                                                                View
                                                            </a>
                                                            <button type="button"
                                                                class="btn btn-sm btn-danger"
                                                                onclick="deleteFile(<?php echo $file['id']; ?>)">
                                                                Delete
                                                            </button>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <button type="submit" name="update-btn" class="btn btn-primary">Update Resource</button>
                                <a href="learning-resources.php" class="btn btn-secondary">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('../components/script.php'); ?>

    <script>
        function deleteFile(fileId) {
            if (confirm('Are you sure you want to delete this file?')) {
                window.location.href = `delete-file.php?file_id=${fileId}&resource_id=<?php echo $resource_id; ?>`;
            }
        }
    </script>
</body>

<?php
function getFileIconClass($extension)
{
    switch (strtolower($extension)) {
        case 'pdf':
            return 'far fa-file-pdf text-danger';
        case 'ppt':
        case 'pptx':
            return 'far fa-file-powerpoint text-danger';
        case 'jpg':
        case 'jpeg':
        case 'png':
        case 'gif':
            return 'far fa-file-image text-primary';
        default:
            return 'far fa-file text-secondary';
    }
}
?>