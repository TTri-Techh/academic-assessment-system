<?php
require '../../vendor/autoload.php';
include('../components/header.php');

use app\controllers\AdminAuthController;
use core\helpers\AlertHelper;


$adminAuthController = new AdminAuthController();

// Redirect to dashboard page if authenticated
if ($adminAuthController->isAuthenticated()) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['password'] = $_POST['password'];

    if ($adminAuthController->login($_SESSION['email'], $_SESSION['password'])) {
        header("Location: index.php?login=success");
        exit();
    } else {
        $error = "Invalid email or password";
    }
}

if (isset($_GET['logout']) && $_GET['logout'] === 'success') {
    AlertHelper::showAlert('Logged out!', 'You are successfully logged out!', 'success');
}

?>

<body>
    <div class="main-wrapper">
        <div class="page-wrapper full-page">
            <div class="page-content d-flex align-items-center justify-content-center">

                <div class="row w-100 mx-0 auth-page">
                    <div class="col-md-8 col-xl-4 mx-auto">
                        <div class="card p-4">
                            <div class="row">
                                <!-- Image div -->
                                <!-- <div class="col-md-4 pe-md-0">
                                    <div class="auth-side-wrapper">

                                    </div>
                                </div> -->
                                <div class="col-md-12 ps-md-0">
                                    <div class="auth-form-wrapper px-4">
                                        <a href="#" class="noble-ui-logo d-block mb-2">Welcome<span> Back</span></a>
                                        <h5 class="text-muted fw-normal mb-4">Log in to admin account.</h5>
                                        <form class="forms-sample" method="POST">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" name="email" class="form-control" id="email"
                                                    value="<?= $_SESSION['email'] ?? "" ?>" placeholder="Enter email"
                                                    required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Password</label>
                                                <input type="password" name="password" class="form-control"
                                                    id="password" value="<?= $_SESSION['password'] ?? "" ?>"
                                                    autocomplete="current-password" placeholder="Enter password"
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
                                                <input type="submit" value="Login"
                                                    class="btn btn-primary col-12 me-2 my-2 mb-md-0 text-white">
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