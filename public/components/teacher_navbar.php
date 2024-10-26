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