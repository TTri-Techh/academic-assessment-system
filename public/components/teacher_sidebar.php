<?php
$currentPage = basename($_SERVER['PHP_SELF']);
$current_subject_id = isset($_GET['subject_id']) ? (int)$_GET['subject_id'] : null;
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
            <!-- <li class="nav-item nav-category">Main</li>
            <li class="nav-item">
                <a href="index.php" class="nav-link">
                    <i class="link-icon" data-feather="home"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li> -->

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
                            <a href="view-students.php"
                                class="nav-link <?php echo ($currentPage == 'view-students.php') ? 'active' : ''; ?>">
                                View students
                            </a>
                        </li>

                    </ul>
                </div>
            </li>
            <!--End For Teacher -->

            <!-- For Assessment  -->
            <?php if ($_SESSION['class_id'] == 0): ?>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#assessment-pages" role="button" aria-expanded="false"
                        aria-controls="assessment-pages">
                        <i class="link-icon" data-feather="file-text"></i>
                        <span class="link-title">Assessment</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="assessment-pages">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <a href="assessment.php"
                                    class="nav-link <?php echo ($currentPage == 'assessment.php') ? 'active' : ''; ?>">
                                    Assessment
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            <?php elseif ($_SESSION['class_id'] != 0): ?>
                <!-- For Assessment by Chapter -->
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#chapterly-assessment" role="button" aria-expanded="false"
                        aria-controls="chapterly-assessment">
                        <i class="link-icon" data-feather="file-text"></i>
                        <span class="link-title">Assessment by Chapter</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="chapterly-assessment">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <a href="chapterly-assessment.php?subject_id=1&chapter_id=1"
                                    class="nav-link <?php echo ($currentPage === 'chapterly-assessment.php?subject_id=1&chapter_id=1') ? 'active' : ''; ?>">
                                    Myanmar
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="chapterly-assessment.php?subject_id=2&chapter_id=1"
                                    class="nav-link <?php echo ($currentPage === 'chapterly-assessment.php?subject_id=2&chapter_id=1') ? 'active' : ''; ?>">
                                    English
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="chapterly-assessment.php?subject_id=3&chapter_id=1"
                                    class="nav-link <?php echo ($currentPage === 'chapterly-assessment.php?subject_id=3&chapter_id=1') ? 'active' : ''; ?>">
                                    Mathematics
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="chapterly-assessment.php?subject_id=4&chapter_id=1"
                                    class="nav-link <?php echo ($currentPage === 'chapterly-assessment.php?subject_id=4&chapter_id=1') ? 'active' : ''; ?>">
                                    Science
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="chapterly-assessment.php?subject_id=5&chapter_id=1"
                                    class="nav-link <?php echo ($currentPage === 'chapterly-assessment.php?subject_id=5&chapter_id=1') ? 'active' : ''; ?>">
                                    Social Studies
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- End For Assessment by Chapter -->
                <?php if ($_SESSION['class_id'] == 1 || $_SESSION['class_id'] == 2 || $_SESSION['class_id'] == 3): ?>
                    <!-- For Assessment by Month -->
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#monthly-assessment" role="button" aria-expanded="false"
                            aria-controls="monthly-assessment">
                            <i class="link-icon" data-feather="file-text"></i>
                            <span class="link-title">Assessment by Month</span>
                            <i class="link-arrow" data-feather="chevron-down"></i>
                        </a>
                        <div class="collapse" id="monthly-assessment">
                            <ul class="nav sub-menu">
                                <li class="nav-item">
                                    <a href="monthly-assessment.php?subject_id=1&month_no=1"
                                        class="nav-link <?php echo ($currentPage === 'monthly-assessment.php' && isset($_GET['subject_id']) && $_GET['subject_id'] == 1) ? 'active' : ''; ?>">
                                        Myanmar
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="monthly-assessment.php?subject_id=2&month_no=1"
                                        class="nav-link <?php echo ($currentPage === 'monthly-assessment.php' && isset($_GET['subject_id']) && $_GET['subject_id'] == 2) ? 'active' : ''; ?>">
                                        English
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="monthly-assessment.php?subject_id=3&month_no=1"
                                        class="nav-link <?php echo ($currentPage === 'monthly-assessment.php' && isset($_GET['subject_id']) && $_GET['subject_id'] == 3) ? 'active' : ''; ?>">
                                        Mathematics
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="monthly-assessment.php?subject_id=4&month_no=1"
                                        class="nav-link <?php echo ($currentPage === 'monthly-assessment.php' && isset($_GET['subject_id']) && $_GET['subject_id'] == 4) ? 'active' : ''; ?>">
                                        Science
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="monthly-assessment.php?subject_id=5&month_no=1"
                                        class="nav-link <?php echo ($currentPage === 'monthly-assessment.php' && isset($_GET['subject_id']) && $_GET['subject_id'] == 5) ? 'active' : ''; ?>">
                                        Social Studies
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                <?php endif; ?>
                <!-- End For Monthly Test -->
                <?php if ($_SESSION['class_id'] == 4 || $_SESSION['class_id'] == 5): ?>
                    <!-- For Monthly Test -->
                    <li class="nav-item">
                        <a href="monthly-test.php"
                            class="nav-link <?php echo ($currentPage == 'monthly-test.php') ? 'active' : ''; ?>">
                            <i class="link-icon" data-feather="file-text"></i>
                            <span class="link-title">Monthly Test</span>
                        </a>
                    </li>
                    <!-- End For Monthly Test -->
                <?php endif; ?>
            <?php endif; ?>
            <!--End For Assessment -->
        </ul>
    </div>
</nav>