<?php
require '../../vendor/autoload.php';
include('../components/header.php');

use app\controllers\TeacherController;

$teacherController = new TeacherController();

// Redirect to dashboard page if authenticated
if ($teacherController->isAuthenticated()) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update-btn'])) {
    $_SESSION['teacher_new_password'] = $_POST['password'];
    $_SESSION['teacher_confrim_password'] = $_POST['confrim_password'];

    if ($_SESSION['teacher_new_password'] !== $_SESSION['teacher_confrim_password']) {
        $error = "Password does not match";
    } elseif ($teacherController->updatePassword($_SESSION['teacher_username'], $_SESSION['teacher_new_password'])) {
        header("Location: index.php?login=success");
        exit();
    } else {
        $error = "Invalid password";
    }
}


?>

<body>
    <div class="main-wrapper">
        <div class="page-wrapper full-page">
            <div class="page-content d-flex align-items-center justify-content-center">

                <div class="row w-100 mx-0 auth-page">
                    <div class="col-md-8 col-xl-6 mx-auto">
                        <div class="card">
                            <div class="row">
                                <!-- Image div -->
                                <div class="col-md-4 pe-md-0">
                                    <div class="auth-side-wrapper">

                                    </div>
                                </div>
                                <div class="col-md-8 ps-md-0">
                                    <div class="auth-form-wrapper px-4 py-5">
                                        <h3 class="text-muted fw-normal mb-4">Change Password.</h3>
                                        <form class="forms-sample" method="POST">
                                            <div class="mb-3">
                                                <label for="password" class="form-label">New Password</label>
                                                <input type="password" name="password" class="form-control"
                                                    id="password" value="<?= $_SESSION['teacher_new_password'] ?? "" ?>"
                                                    autocomplete="current-password" placeholder="Enter new password"
                                                    required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="confrim_password" class="form-label">Comfrim Password</label>
                                                <input type="password" name="confrim_password" class="form-control"
                                                    id="confrim_password" value="<?= $_SESSION['teacher_confrim_password'] ?? "" ?>"
                                                    autocomplete="current-password" placeholder="Enter new password"
                                                    required>
                                            </div>
                                            <?php if (isset($error)): ?>

                                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                    <?php echo $error; ?>

                                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                        aria-label="btn-close"></button>
                                                </div>

                                            <?php endif; ?>

                                            <div>
                                                <input type="submit" value="Change Password" name="update-btn"
                                                    class="btn btn-primary me-2 mb-2 mb-md-0 text-white">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--  JavaScript -->
    <?php
    include('../components/script.php');
    ?>
</body>

</html>