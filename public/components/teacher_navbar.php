<?php

use app\controllers\QcprController;
use core\helpers\AlertHelper;
use core\helpers\Helper;

$announcement = new QcprController();

// get announcement status
$status = $announcement->getAnnouncementStatus();
// change announcement status when form is submitted
if (isset($_POST['status'])) {
    $announcement->changeAnnouncementStatus($_POST['status']);
    if ($_SESSION['announcement_status'] == 1) {
        AlertHelper::showAlert('ကြေညာခြင်း', 'QCPR အားကျောင်းသားများမှ ကြည့်ရှုနိုင်ပါပြီ.', 'success');
    } else {
        AlertHelper::showAlert('ကြေညာခြင်း', 'QCPR အားကျောင်းသားများမှ ကြည့်ရှုနိုင်မည်မဟုတ်ပါ။', 'error');
    }
    $status = $announcement->getAnnouncementStatus();

    echo "<script>window.location.href = 'register-students.php';</script>";
}
?>

<div class="page-wrapper">

    <!-- partial:partials/_navbar.html -->
    <nav class="navbar">
        <a href="#" class="sidebar-toggler">
            <i data-feather="menu"></i>
        </a>
        <div class="navbar-content">
            <ul class="navbar-nav">
                <!-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="flag-icon flag-icon-us mt-1" title="us"></i> <span class="ms-1 me-1 d-none d-md-inline-block">English</span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="languageDropdown">
                        <a href="javascript:;" class="dropdown-item py-2"><i class="flag-icon flag-icon-us" title="us" id="us"></i> <span class="ms-1"> English </span></a>
                        <a href="javascript:;" class="dropdown-item py-2"><i class="flag-icon flag-icon-mm" title="mm" id="mm"></i> <span class="ms-1"> Myanmar </span></a>
                    </div>
                </li> -->
                <li class="nav-item">
                    <!-- change announcement status and submit form -->
                    <form action="" method="POST">
                        <select name="status" id="status" class="form-select <?= $status == 0 ? 'text-warning' : 'text-success' ?>" onchange="this.form.submit()">
                            <option value="0" <?= $status == 0 ? 'selected' : '' ?>> <?= $status == 0 ? 'QCPR ရမှတ်များကို ပိတ်သိမ်းထားသည်' : 'QCPR ရမှတ်များကို ပိတ်သိမ်းမည်' ?> </option>
                            <option value="1" <?= $status == 1 ? 'selected' : '' ?>> <?= $status == 1 ? 'ကျောင်းသားများ၏ QCPR ရမှတ်များကို ကြေညာထားသည်' : 'ကျောင်းသားများ၏ QCPR ရမှတ်များကို ကြေညာမည်' ?></option>
                        </select>
                    </form>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="wd-30 ht-30 rounded-circle" src="../assets/images/faces/profile.png" alt="profile">
                    </a>
                    <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
                        <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
                            <div class="mb-3">
                                <img class="wd-80 ht-80 rounded-circle" src="../assets/images/faces/profile.png" alt="">
                            </div>
                            <div class="text-center">
                                <p class="tx-16 fw-bolder"><?= $_SESSION['teacher_name'] ?></p>
                                <p class="tx-12 text-muted p-2"><?= $_SESSION['teacher_username'] ?></p>
                                <p class="tx-12 text-muted">သင်ကြားသည့်အတန်း - <span class="fw-bolder text-primary"><?= $_SESSION['class_name'] ?></span></p>

                            </div>
                        </div>
                        <ul class="list-unstyled p-1">
                            <a href="logout.php" class="text-body ms-0">
                                <li class="dropdown-item py-2">
                                    <i class="me-2 icon-md" data-feather="log-out"></i>
                                    <span>Log Out</span>
                                </li>
                            </a>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <!-- partial -->