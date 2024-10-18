<?php

require '../../vendor/autoload.php';
include('../components/header.php');

use app\controllers\AdminAuthController;

$adminAuthController = new AdminAuthController();
if (!$adminAuthController->isAuthenticated()) {
    header("Location:login.php");
    exit();
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
            <!-- Start Table -->
            <div class="col-lg-12 col-xl-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline mb-2">
                            <h6 class="card-title mb-0">ဆရာ/ဆရာမများ</h6>
                            <div class="dropdown mb-2">
                                <a type="button" id="dropdownMenuButton7" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton7">
                                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="edit-2" class="icon-sm me-2"></i> <span class="">Edit</span></a>
                                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="trash" class="icon-sm me-2"></i> <span class="">Delete</span></a>
                                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="printer" class="icon-sm me-2"></i> <span class="">Print</span></a>
                                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="download" class="icon-sm me-2"></i> <span class="">Download</span></a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th class="pt-0">စဉ်</th>
                                        <th class="pt-0">အမည်</th>
                                        <th class="pt-0">အသုံးပြုသူအမည်</th>
                                        <th class="pt-0">ဖုန်း</th>
                                        <th class="pt-0">Due Date</th>
                                        <th class="pt-0">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>NobleUI jQuery</td>
                                        <td>01/01/2022</td>
                                        <td>26/04/2022</td>
                                        <td><span class="badge bg-danger">Released</span></td>
                                        <td>Leonardo Payne</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>NobleUI Angular</td>
                                        <td>01/01/2022</td>
                                        <td>26/04/2022</td>
                                        <td><span class="badge bg-success">Review</span></td>
                                        <td>Carl Henson</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>NobleUI ReactJs</td>
                                        <td>01/05/2022</td>
                                        <td>10/09/2022</td>
                                        <td><span class="badge bg-info">Pending</span></td>
                                        <td>Jensen Combs</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>NobleUI VueJs</td>
                                        <td>01/01/2022</td>
                                        <td>31/11/2022</td>
                                        <td><span class="badge bg-warning">Work in Progress</span>
                                        </td>
                                        <td>Amiah Burton</td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>NobleUI Laravel</td>
                                        <td>01/01/2022</td>
                                        <td>31/12/2022</td>
                                        <td><span class="badge bg-danger">Coming soon</span></td>
                                        <td>Yaretzi Mayo</td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>NobleUI NodeJs</td>
                                        <td>01/01/2022</td>
                                        <td>31/12/2022</td>
                                        <td><span class="badge bg-primary">Coming soon</span></td>
                                        <td>Carl Henson</td>
                                    </tr>
                                    <tr>
                                        <td class="border-bottom">3</td>
                                        <td class="border-bottom">NobleUI EmberJs</td>
                                        <td class="border-bottom">01/05/2022</td>
                                        <td class="border-bottom">10/11/2022</td>
                                        <td class="border-bottom"><span class="badge bg-info">Pending</span></td>
                                        <td class="border-bottom">Jensen Combs</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End table -->
        </div>
    </div>
</body>

<!--  JavaScript -->
<?php
include('../components/script.php');
?>