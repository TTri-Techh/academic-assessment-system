        <?php

        require '../../vendor/autoload.php';
        include('../components/header.php');

        use app\controllers\StudentController;
        use app\controllers\TeacherController;
        use core\helpers\AlertHelper;

        $teacherController = new TeacherController();
        $studentController = new StudentController();
        if (!$teacherController->isAuthenticated()) {
            header("Location:login.php");
            exit();
        }

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

                    </div>
                </div>
            </div>
        </body>

        <?php
        include('../components/script.php');
        ?>