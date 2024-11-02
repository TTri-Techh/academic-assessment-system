<?php
require '../vendor/autoload.php';

use app\controllers\QcprController;
use app\controllers\StudentController;
use app\controllers\MonthlyAssessmentController;
use app\controllers\MonthlyTestController;
use core\helpers\AlertHelper;
use core\helpers\Helper;

$studentController = new StudentController();
$qcprController = new QcprController();
$monthlyAssessmentController = new MonthlyAssessmentController();
$monthlyTestController = new MonthlyTestController();
// Display success message if login is successful
if ((isset($_GET['login']) && $_GET['login'] === 'success')) {
  AlertHelper::showAlert('Congratulation', 'You are successfully logged in.', 'success');
} else if (isset($_GET['logout']) && $_GET['logout'] === 'success') {
  AlertHelper::showAlert('Logout', 'You are successfully logged out.', 'success');
}
$student_id = $_SESSION['student_id'] ?? null;
$class_id = $_SESSION['class_id'] ?? null;
$isAuthenticated = $studentController->isAuthenticated();
if ($isAuthenticated) {
  $announcementStatus = $qcprController->getAnnouncementStatus($_SESSION['class_id']);
  // get monthly assessment by student id and class id for grade 1, 2, 3
  if ($_SESSION['class_id'] == 1 || $_SESSION['class_id'] == 2 || $_SESSION['class_id'] == 3) {
    $monthlyAssessment = $monthlyAssessmentController->getMonthlyAssessmentByStudentId($_SESSION['student_id'], $_SESSION['class_id']);
  }
  // get monthly test by student id and class id for grade 4, 5, 6
  if ($_SESSION['class_id'] == 4 || $_SESSION['class_id'] == 5) {
    $monthlyTest = $monthlyTestController->getMonthlyTestByStudentId($_SESSION['student_id'], $_SESSION['class_id']);
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="assets/fonts/google-font/poppins.css" rel="stylesheet">
  <link rel="icon" href="assets/images/favicon.png" type="image/x-icon">

  <title>Academic Assessment System</title>

  <!-- Bootstrap core CSS -->
  <link href="assets/vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">


  <!-- Additional CSS Files -->
  <link rel="stylesheet" href="assets/css/fontawesome.css">
  <link rel="stylesheet" href="assets/css/templatemo-scholar.css">
  <link rel="stylesheet" href="assets/css/owl.css">
  <link rel="stylesheet" href="assets/css/animate.css">
  <link rel="stylesheet" href="assets/css/swiper-bundle.min.css" />
  <link rel="stylesheet" href="assets/vendors/sweetalert2/sweetalert2.min.css">
  <link rel="stylesheet" href="assets/fonts/feather-font/css/iconfont.css">


</head>

<body>
  <!-- ***** Preloader Start ***** -->
  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>
  <!-- ***** Preloader End ***** -->

  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav class="main-nav">
            <!-- ***** Logo Start ***** -->
            <a href="index.php" class="logo">
              <h1>AAS</h1>
            </a>
            <!-- ***** Logo End ***** -->

            <!-- ***** Menu Start ***** -->
            <ul class="nav">
              <li class="scroll-to-section"><a href="#top" class="active">Home</a></li>
              <li class="scroll-to-section"><a href="#qcpr">QCPR</a></li>
              <?php if ($studentController->isAuthenticated()) : ?>
                <!-- <li class=""><a href="student/learning-resources.php">Learning Resources</a></li> -->
                <li class=""><a href="student/logout.php">Logout</a></li>
              <?php else : ?>
                <li class=""><a href="teacher/login.php">For Teachers</a></li>
              <?php endif; ?>
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

  <div class="main-banner" id="top">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="header-text">
            <span class="category">For Primary Levels</span>
            <h2 class="">Academic Assessment System</h2>
            <p class="my-2 text-white">Academic Assessment System for Basic Education primary school in Myanmar.</p>
            <div class="buttons">
              <?php if (!$studentController->isAuthenticated()) : ?>
                <div class="main-button">
                  <a href="student/login.php">Login as student</a>
                </div>
              <?php else : ?>
                <div class="main-button">
                  <a class="scroll-to-section" href="#qcpr">View QCPR</a>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



  <section class="section qcpr" id="qcpr">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <div class="section-heading">
            <h3>ဘက်စုံပညာအရည်အချင်းမှတ်တမ်း</h3>
            <h2 class="text-primary">Quartely Comprehensive Personal Report - QCPR</h2>
            <h5>အခြေခံပညာမူလတန်းအဆင့် (Primary Level)</h5>
          </div>
        </div>
      </div>
      <?php if ($isAuthenticated && $announcementStatus) : ?>
        <!-- start show qcpr -->
        <div class="container position-relative">
          <div class="row">
            <div class="col-lg-12 card shadow-sm border-0 p-4 rounded-3 main-banner text-white">
              <!-- Add blur wrapper -->
              <div class="blur-wrapper " id="qcprContent">
                <div class="col-lg-3 mb-3 bg-white p-3 rounded-3">
                  <p><b class="text-dark">အမည်</b> : <?= $_SESSION['student_name'] ?></p>
                  <p><b class="text-dark">အတန်း</b> : <?= $_SESSION['class_name'] ?></p>
                </div>
                <?php if ($_SESSION['class_id'] == 1 || $_SESSION['class_id'] == 2 || $_SESSION['class_id'] == 3) : ?>
                  <!-- table start for Grade 1, 2, 3 -->
                  <table class="table table-bordered table-hover text-white text-center">
                    <thead>
                      <tr>
                        <th>ဘာသာရပ်</th>
                        <th>အခန်းဆုံးတတ်မြောက်မှု <br> စစ်ဆေးခြင်း <br> (Chapter End Test) </th>
                        <th>နှစ်ဝက်ဆုံးတတ်မြောက်မှု <br> စစ်ဆေးခြင်း <br> (Midterm Test) </th>
                        <th>အခန်းဆုံးတတ်မြောက်မှု <br> စစ်ဆေးခြင်း <br> (Chapter End Test) </th>
                        <th>နှစ်ဆုံးတတ်မြောက်မှု <br> စစ်ဆေးခြင်း <br> (Final End Test) </th>
                        <th>ပျမ်းမျှအဆင့်</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>မြန်မာစာ</td>
                        <td><?= Helper::getLowerGradeBySubjectId($monthlyAssessment, 1, 1) ?></td>
                        <td><?= Helper::getLowerGradeBySubjectId($monthlyAssessment, 1, 2) ?></td>
                        <td><?= Helper::getLowerGradeBySubjectId($monthlyAssessment, 1, 3) ?></td>
                        <td><?= Helper::getLowerGradeBySubjectId($monthlyAssessment, 1, 4) ?></td>
                        <td><?= Helper::calculateLowerAverageGrade($monthlyAssessment, 1) ?></td>
                      </tr>
                      <tr>
                        <td>အင်္ဂလိပ်စာ</td>
                        <td><?= Helper::getLowerGradeBySubjectId($monthlyAssessment, 2, 1) ?></td>
                        <td><?= Helper::getLowerGradeBySubjectId($monthlyAssessment, 2, 2) ?></td>
                        <td><?= Helper::getLowerGradeBySubjectId($monthlyAssessment, 2, 3) ?></td>
                        <td><?= Helper::getLowerGradeBySubjectId($monthlyAssessment, 2, 4) ?></td>
                        <td><?= Helper::calculateLowerAverageGrade($monthlyAssessment, 2) ?></td>
                      </tr>
                      <tr>
                        <td>သင်္ချာ</td>
                        <td><?= Helper::getLowerGradeBySubjectId($monthlyAssessment, 3, 1) ?></td>
                        <td><?= Helper::getLowerGradeBySubjectId($monthlyAssessment, 3, 2) ?></td>
                        <td><?= Helper::getLowerGradeBySubjectId($monthlyAssessment, 3, 3) ?></td>
                        <td><?= Helper::getLowerGradeBySubjectId($monthlyAssessment, 3, 4) ?></td>
                        <td><?= Helper::calculateLowerAverageGrade($monthlyAssessment, 3) ?></td>
                      </tr>
                      <tr>
                        <td>သိပ္ပံ</td>
                        <td><?= Helper::getLowerGradeBySubjectId($monthlyAssessment, 4, 1) ?></td>
                        <td><?= Helper::getLowerGradeBySubjectId($monthlyAssessment, 4, 2) ?></td>
                        <td><?= Helper::getLowerGradeBySubjectId($monthlyAssessment, 4, 3) ?></td>
                        <td><?= Helper::getLowerGradeBySubjectId($monthlyAssessment, 4, 4) ?></td>
                        <td><?= Helper::calculateLowerAverageGrade($monthlyAssessment, 4) ?></td>
                      </tr>
                      <tr>
                        <td>လူမှုရေး</td>
                        <td><?= Helper::getLowerGradeBySubjectId($monthlyAssessment, 5, 1) ?></td>
                        <td><?= Helper::getLowerGradeBySubjectId($monthlyAssessment, 5, 2) ?></td>
                        <td><?= Helper::getLowerGradeBySubjectId($monthlyAssessment, 5, 3) ?></td>
                        <td><?= Helper::getLowerGradeBySubjectId($monthlyAssessment, 5, 4) ?></td>
                        <td><?= Helper::calculateLowerAverageGrade($monthlyAssessment, 5) ?></td>
                      </tr>
                    </tbody>
                  </table>
                  <!-- table end for Grade 1, 2, 3 -->
                <?php endif; ?>

                <?php if ($_SESSION['class_id'] == 4 || $_SESSION['class_id'] == 5) : ?>
                  <!-- table start for Grade 4, 5 -->
                  <table class="table table-bordered table-hover text-white text-center">
                    <thead>
                      <tr>
                        <th>ဘာသာရပ်</th>
                        <th>အခန်းဆုံးတတ်မြောက်မှု <br> စစ်ဆေးခြင်း <br> (Chapter End Test) </th>
                        <th>နှစ်ဝက်ဆုံးတတ်မြောက်မှု <br> စစ်ဆေးခြင်း <br> (Midterm Test) </th>
                        <th>အခန်းဆုံးတတ်မြောက်မှု <br> စစ်ဆေးခြင်း <br> (Chapter End Test) </th>
                        <th>နှစ်ဆုံးတတ်မြောက်မှု <br> စစ်ဆေးခြင်း <br> (Final End Test) </th>
                        <th>ပျမ်းမျှအဆင့်</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>မြန်မာစာ</td>
                        <td><?= Helper::getUpperGradeBySubject($monthlyTest, 'myanmar', 1) ?></td>
                        <td><?= Helper::getUpperGradeBySubject($monthlyTest, 'myanmar', 2) ?></td>
                        <td><?= Helper::getUpperGradeBySubject($monthlyTest, 'myanmar', 3) ?></td>
                        <td><?= Helper::getUpperGradeBySubject($monthlyTest, 'myanmar', 4) ?></td>
                        <td><?= Helper::calculateAverageGrade($monthlyTest, 'myanmar') ?></td>
                      </tr>
                      <tr>
                        <td>အင်္ဂလိပ်စာ</td>
                        <td><?= Helper::getUpperGradeBySubject($monthlyTest, 'english', 1) ?></td>
                        <td><?= Helper::getUpperGradeBySubject($monthlyTest, 'english', 2) ?></td>
                        <td><?= Helper::getUpperGradeBySubject($monthlyTest, 'english', 3) ?></td>
                        <td><?= Helper::getUpperGradeBySubject($monthlyTest, 'english', 4) ?></td>
                        <td><?= Helper::calculateAverageGrade($monthlyTest, 'english') ?></td>
                      </tr>
                      <tr>
                        <td>သင်္ချာ</td>
                        <td><?= Helper::getUpperGradeBySubject($monthlyTest, 'math', 1) ?></td>
                        <td><?= Helper::getUpperGradeBySubject($monthlyTest, 'math', 2) ?></td>
                        <td><?= Helper::getUpperGradeBySubject($monthlyTest, 'math', 3) ?></td>
                        <td><?= Helper::getUpperGradeBySubject($monthlyTest, 'math', 4) ?></td>
                        <td><?= Helper::calculateAverageGrade($monthlyTest, 'math') ?></td>
                      </tr>
                      <tr>
                        <td>သိပ္ပံ</td>
                        <td><?= Helper::getUpperGradeBySubject($monthlyTest, 'science', 1) ?></td>
                        <td><?= Helper::getUpperGradeBySubject($monthlyTest, 'science', 2) ?></td>
                        <td><?= Helper::getUpperGradeBySubject($monthlyTest, 'science', 3) ?></td>
                        <td><?= Helper::getUpperGradeBySubject($monthlyTest, 'science', 4) ?></td>
                        <td><?= Helper::calculateAverageGrade($monthlyTest, 'science') ?></td>
                      </tr>
                      <tr>
                        <td>လူမှုရေး</td>
                        <td><?= Helper::getUpperGradeBySubject($monthlyTest, 'social', 1) ?></td>
                        <td><?= Helper::getUpperGradeBySubject($monthlyTest, 'social', 2) ?></td>
                        <td><?= Helper::getUpperGradeBySubject($monthlyTest, 'social', 3) ?></td>
                        <td><?= Helper::getUpperGradeBySubject($monthlyTest, 'social', 4) ?></td>
                        <td><?= Helper::calculateAverageGrade($monthlyTest, 'social') ?></td>
                      </tr>
                    </tbody>
                  </table>
                  <!-- table end for Grade 4, 5 -->
                <?php endif; ?>
              </div>

              <!-- Add view button -->
              <button id="viewBtn" class="btn btn-light position-absolute top-50 start-50 translate-middle">
                <!-- <i class="link-icon" data-feather="eye"></i> 👀--> 👁‍🗨 ကြည့်ရှုရန်
              </button>
            </div>
          </div>
        </div>
        <!-- end show qcpr -->

      <?php elseif ($isAuthenticated && !$announcementStatus) : ?>
        <div class="container">
          <div class="row">
            <div class="col-lg-12 text-center">
              <div class="card shadow-sm border-0 p-4 rounded-3`">
                <div class="card-title">
                  <p class="text-danger">QCPR အားစစ်ဆေးရန်အချိန်ကာလကို သက်ဆိုင်ရာ ဆရာ/မများမှ သတ်မှတ်ထားသည့် <br> အချိန်ကာလတွင်ကျောင်းသား/သူများအား အသိပေးသွားမည်ဖြစ်ပါသည်။</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php else : ?>
        <div class="container">
          <div class="col-lg-12 text-center">
            <div class="card shadow-sm border-0 p-4 rounded-3`">
              <div class="card-title">
                <p class="text-danger">QCPR အားကြည့်ရှုရန် မိမိ၏ ကျောင်းသား account အား login ဝင်ရောက်ရန်လိုအပ်ပါသည်။</p>
              </div>
            </div>
          </div>
        </div>

      <?php endif; ?>

    </div>
  </section>




  <footer>
    <div class="container">
      <div class="col-lg-12">
        <p>Copyright © 2024. Academic Assessment System</p>
      </div>
    </div>
  </footer>

  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
  <script src="assets/vendors/jquery/jquery.min.js"></script>
  <script src="assets/vendors/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/js/isotope.min.js"></script>
  <script src="assets/js/owl-carousel.js"></script>
  <script src="assets/js/counter.js"></script>
  <script src="assets/js/custom.js"></script>
  <script src="assets/vendors/sweetalert2/sweetalert2.min.js"></script>


</body>

</html>

<!-- Add CSS -->
<style>
  .blur-wrapper {
    filter: blur(8px);
    pointer-events: none;
    user-select: none;
  }

  .blur-wrapper.active {
    filter: none;
    pointer-events: auto;
    user-select: auto;
  }

  #viewBtn {
    z-index: 100;
  }

  #viewBtn.hidden {
    display: none;
  }
</style>

<!-- Add JavaScript -->
<script>
  document.getElementById('viewBtn').addEventListener('click', function() {
    document.getElementById('qcprContent').classList.add('active');
    this.classList.add('hidden');
  });
</script>