<?php

require '../../vendor/autoload.php';

// Add these helper functions here
function formatFileSize($bytes)
{
    if ($bytes >= 1073741824) {
        return number_format($bytes / 1073741824, 2) . ' GB';
    } elseif ($bytes >= 1048576) {
        return number_format($bytes / 1048576, 2) . ' MB';
    } elseif ($bytes >= 1024) {
        return number_format($bytes / 1024, 2) . ' KB';
    } else {
        return $bytes . ' bytes';
    }
}

function getFileIconAndColor($extension)
{
    return match ($extension) {
        'pdf' => ['file-text', 'bg-danger'],
        'doc', 'docx' => ['file-text', 'bg-primary'],
        'xls', 'xlsx' => ['file-text', 'bg-success'],
        'ppt', 'pptx' => ['monitor', 'bg-warning'],
        'jpg', 'jpeg', 'png', 'gif' => ['image', 'bg-info'],
        'zip', 'rar' => ['archive', 'bg-secondary'],
        'mp4', 'avi', 'mov' => ['video', 'bg-purple'],
        'mp3', 'wav' => ['music', 'bg-pink'],
        default => ['file', 'bg-dark']
    };
}

use app\controllers\ResourcesController;
use app\controllers\SubjectController;
use app\controllers\StudentController;

$studentController = new StudentController();
if (!$studentController->isAuthenticated()) {
    header("Location:login.php");
    exit();
}

$subjectController = new SubjectController();
$subjects = $subjectController->getMainSubjects();

$resourceController = new ResourcesController();
$resources = $resourceController->getResourcesByClassId($_SESSION['class_id']);

// Group resources by subject
$resourcesBySubject = [];
foreach ($resources as $resource) {
    $subjectId = $resource['subject_id'];
    if (!isset($resourcesBySubject[$subjectId])) {
        $resourcesBySubject[$subjectId] = [
            'subject_name' => $resource['subject_name'],
            'resources' => []
        ];
    }
    $resourcesBySubject[$subjectId]['resources'][] = $resource;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="../assets/fonts/google-font/poppins.css" rel="stylesheet">
    <link rel="icon" href="../assets/images/favicon.png" type="image/x-icon">

    <title>Learning Resources - Academic Assessment System</title>

    <!-- Bootstrap core CSS -->
    <link href="../assets/vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="../assets/css/fontawesome.css">
    <link rel="stylesheet" href="../assets/css/templatemo-scholar.css">
    <link rel="stylesheet" href="../assets/css/owl.css">
    <link rel="stylesheet" href="../assets/css/animate.css">
    <link rel="stylesheet" href="../assets/css/swiper-bundle.min.css" />
    <link rel="stylesheet" href="../assets/fonts/feather-font/css/iconfont.css">
</head>

<body>
    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="../index.php" class="logo">
                            <h1>AAS</h1>
                        </a>
                        <!-- ***** Logo End ***** -->

                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li><a href="../index.php">Home</a></li>
                            <li><a href="../index.php#qcpr">QCPR</a></li>
                            <li><a href="learning-resources.php" class="active">Learning Resources</a></li>
                            <li><a href="logout.php">Logout</a></li>
                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->

    <!-- ***** Main Banner Start ***** -->
    <div class="main-banner" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header-text">
                        <h2>Learning Resources</h2>
                        <p class="mb-4 text-white">Access your study materials, notes, and resources here</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner End ***** -->

    <!-- ***** Resources Section Start ***** -->
    <section class="section courses" id="resources">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <h2> <?= $_SESSION['class_name'] ?> Learning Resources</h2>
                    </div>
                </div>

                <!-- Resources Content -->
                <div class="col-lg-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <!-- Tabs for subjects -->
                            <ul class="nav nav-pills mb-4" id="resourceTabs" role="tablist">
                                <?php $first = true; ?>
                                <?php foreach ($resourcesBySubject as $subjectId => $subjectData): ?>
                                    <li class="nav-item me-2">
                                        <a class="nav-link <?= $first ? 'active' : '' ?>"
                                            id="tab-<?= $subjectId ?>"
                                            data-bs-toggle="tab"
                                            href="#subject-<?= $subjectId ?>"
                                            role="tab">
                                            <?= $subjectData['subject_name'] ?>
                                        </a>
                                    </li>
                                    <?php $first = false; ?>
                                <?php endforeach; ?>
                            </ul>

                            <!-- Tab content -->
                            <div class="tab-content" id="resourceTabContent">
                                <?php $first = true; ?>
                                <?php foreach ($resourcesBySubject as $subjectId => $subjectData): ?>
                                    <div class="tab-pane fade <?= $first ? 'show active' : '' ?>"
                                        id="subject-<?= $subjectId ?>"
                                        role="tabpanel">

                                        <?php
                                        // Group resources by chapter
                                        $chapterResources = [];
                                        foreach ($subjectData['resources'] as $resource) {
                                            $chapterNo = $resource['chapter_no'];
                                            if (!isset($chapterResources[$chapterNo])) {
                                                $chapterResources[$chapterNo] = [
                                                    'name' => $resource['chapter_name'],
                                                    'resources' => []
                                                ];
                                            }
                                            $chapterResources[$chapterNo]['resources'][] = $resource;
                                        }
                                        ksort($chapterResources); // Sort by chapter number
                                        ?>

                                        <div class="accordion" id="accordion-<?= $subjectId ?>">
                                            <?php foreach ($chapterResources as $chapterNo => $chapter): ?>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#chapter-<?= $subjectId ?>-<?= $chapterNo ?>">
                                                            Chapter <?= $chapterNo ?>: <?= $chapter['name'] ?>
                                                        </button>
                                                    </h2>
                                                    <div id="chapter-<?= $subjectId ?>-<?= $chapterNo ?>"
                                                        class="accordion-collapse collapse"
                                                        data-bs-parent="#accordion-<?= $subjectId ?>">
                                                        <div class="accordion-body">
                                                            <?php foreach ($chapter['resources'] as $resource): ?>
                                                                <div class="card mb-3">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">
                                                                            <i data-feather="book-open" class="me-2"></i>
                                                                            <?= $resource['title'] ?>
                                                                        </h5>
                                                                        <p class="card-text text-muted"><?= $resource['description'] ?></p>

                                                                        <?php if (!empty($resource['files'])): ?>
                                                                            <div class="resource-files mt-3">
                                                                                <h6 class="mb-3">
                                                                                    <i data-feather="paperclip" class="me-2"></i>
                                                                                    Attached Files:
                                                                                </h6>
                                                                                <div class="row g-2">
                                                                                    <?php
                                                                                    $files = explode(',', $resource['files']);
                                                                                    foreach ($files as $file):
                                                                                        $fileName = basename($file);
                                                                                        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                                                                                        [$icon, $color] = getFileIconAndColor($fileExt);
                                                                                    ?>
                                                                                        <div class="col-md-6 col-lg-4">
                                                                                            <div class="file-card p-2 border rounded">
                                                                                                <div class="d-flex align-items-center">
                                                                                                    <div class="file-icon me-2 rounded-circle p-2 <?= $color ?>">
                                                                                                        <i data-feather="<?= $icon ?>" class="text-white"></i>
                                                                                                    </div>
                                                                                                    <div class="file-info flex-grow-1">
                                                                                                        <div class="small fw-bold text-truncate" title="<?= $fileName ?>">
                                                                                                            <?= $fileName ?>
                                                                                                        </div>
                                                                                                        <?php
                                                                                                        $filePath = $_SERVER['DOCUMENT_ROOT'] . '/' . $file;
                                                                                                        $fileSize = file_exists($filePath) ? filesize($filePath) : 0;
                                                                                                        ?>
                                                                                                        <div class="text-muted small">
                                                                                                            <?= formatFileSize($fileSize) ?>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <a href="/<?= $file ?>"
                                                                                                        class="btn btn-sm btn-outline-primary download-btn ms-2"
                                                                                                        download
                                                                                                        title="Download">
                                                                                                        ⬇
                                                                                                    </a>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    <?php endforeach; ?>
                                                                                </div>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <?php $first = false; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Resources Section End ***** -->

    <footer>
        <div class="container">
            <div class="col-lg-12">
                <p>Copyright © 2024. Academic Assessment System</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="../assets/vendors/jquery/jquery.min.js"></script>
    <script src="../assets/vendors/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/js/isotope.min.js"></script>
    <script src="../assets/js/owl-carousel.js"></script>
    <script src="../assets/js/counter.js"></script>
    <script src="../assets/js/custom.js"></script>
    <script src="../assets/fonts/feather-font/feather.min.js"></script>

    <script>
        feather.replace();
    </script>
    <script>
        document.querySelectorAll('.download-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const icon = btn.querySelector('.download-icon');
                btn.classList.add('downloading');

                // Optional: Change icon to check after download starts
                setTimeout(() => {
                    icon.setAttribute('data-feather', 'check');
                    feather.replace();
                    btn.classList.remove('downloading');

                    // Reset icon after a delay
                    setTimeout(() => {
                        icon.setAttribute('data-feather', 'download');
                        feather.replace();
                    }, 1000);
                }, 1000);
            });
        });
    </script>
</body>

</html>

<style>
    /* Custom styles */
    .nav-pills .nav-link {
        color: #212529;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        margin-bottom: 5px;
    }

    .nav-pills .nav-link.active {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }

    .accordion-button:not(.collapsed) {
        background-color: #e7f1ff;
        color: #0d6efd;
    }

    .card {
        transition: transform 0.2s;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .btn-outline-primary {
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .btn-outline-primary i {
        width: 16px;
        height: 16px;
    }

    .file-card {
        background: #fff;
        transition: all 0.2s ease;
        border-color: #dee2e6 !important;
    }

    .file-card:hover {
        background: #f8f9fa;
        transform: translateY(-2px);
        box-shadow: 0 .125rem .25rem rgba(0, 0, 0, .075);
    }

    .file-icon {
        width: 35px;
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .file-icon i {
        width: 18px;
        height: 18px;
    }

    .file-info {
        min-width: 0;
        /* For text-truncate to work */
    }

    .download-btn {
        padding: 4px;
        width: 28px;
        height: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .download-btn i {
        width: 16px;
        height: 16px;
    }

    .download-btn:hover {
        background-color: #0d6efd;
        color: white;
        border-color: #0d6efd;
    }

    .download-btn:hover .download-icon {
        stroke: white;
    }

    /* Background colors for file types */
    .bg-purple {
        background-color: #6f42c1;
    }

    .bg-pink {
        background-color: #e83e8c;
    }

    /* Additional styles for better visual hierarchy */
    .card-title {
        display: flex;
        align-items: center;
    }

    .resource-files {
        border-top: 1px solid #dee2e6;
        padding-top: 1rem;
    }

    .resource-files h6 {
        display: flex;
        align-items: center;
        color: #6c757d;
    }

    /* Add animation for downloading state */
    .download-btn.downloading {
        animation: downloadPulse 1s infinite;
    }

    @keyframes downloadPulse {
        0% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.1);
        }

        100% {
            transform: scale(1);
        }
    }

    /* Colors for different file types */
    .bg-danger {
        background-color: #dc3545 !important;
    }

    .bg-primary {
        background-color: #0d6efd !important;
    }

    .bg-success {
        background-color: #198754 !important;
    }

    .bg-warning {
        background-color: #ffc107 !important;
    }

    .bg-info {
        background-color: #0dcaf0 !important;
    }

    .bg-secondary {
        background-color: #6c757d !important;
    }

    .bg-purple {
        background-color: #6f42c1 !important;
    }

    .bg-pink {
        background-color: #d63384 !important;
    }

    .bg-dark {
        background-color: #212529 !important;
    }

    .text-white {
        color: #fff !important;
    }
</style>