<?php
$currentPage = basename($_SERVER['PHP_SELF']);

?>
<!-- partial:partials/_sidebar.html -->
<nav class="sidebar">
    <div class="sidebar-header">
        <a href="index.php" class="sidebar-brand">
            AAS<span> teacher</span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item">
                <a href="index.php" class="nav-link">
                    <i class="link-icon" data-feather="home"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>

            <li class="nav-item nav-category">Pages</li>
            <!-- For Teacher  -->
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#students-pages" role="button" aria-expanded="false"
                    aria-controls="students-pages">
                    <i class="link-icon" data-feather="user"></i>
                    <span class="link-title">Students</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="students-pages">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="register-students.php"
                                class="nav-link <?php echo ($currentPage == 'register-students.php') ? 'active' : ''; ?>">
                                Register Students
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="view-teachers.php"
                                class="nav-link <?php echo ($currentPage == 'view-students.php') ? 'active' : ''; ?>">
                                View Teachers
                            </a>
                        </li>

                    </ul>
                </div>
            </li>
            <!--End For Teacher -->

            <!-- For Students -->
            <!-- <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#students-pages" role="button" aria-expanded="false"
                    aria-controls="students-pages">
                    <i class="link-icon" data-feather="user"></i>
                    <span class="link-title">Students</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="students-pages">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="view-students.php"
                                class="nav-link <?php // echo ($currentPage == 'view-students.php') ? 'active' : ''; ?>">
                                View Students
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="students-result.php"
                                class="nav-link <?php // echo ($currentPage == 'students-result.php') ? 'active' : ''; ?>">
                                Students' Results
                            </a>
                        </li>

                    </ul>
                </div>
            </li> -->
            <!--End For Students -->

            <!-- For Classes -->
            <!-- <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#classes-pages" role="button" aria-expanded="false"
                    aria-controls="classes-pages">
                    <i class="link-icon" data-feather="book"></i>
                    <span class="link-title">Classes</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="classes-pages">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="assign-classes.php"
                                class="nav-link <?php // echo ($currentPage == 'assign-classes.php') ? 'active' : ''; ?>">
                                Assign Classes
                            </a>
                        </li>

                    </ul>
                </div>
            </li> -->
            <!--End For Students -->

        </ul>
    </div>
</nav>