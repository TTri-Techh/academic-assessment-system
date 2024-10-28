<?php
require '../vendor/autoload.php';

use app\controllers\StudentController;
use core\helpers\AlertHelper;

$studentController = new StudentController();

// Display success message if login is successful
if ((isset($_GET['login']) && $_GET['login'] === 'success')) {
  AlertHelper::showAlert('Congratulation', 'You are successfully logged in.', 'success');
} else if (isset($_GET['logout']) && $_GET['logout'] === 'success') {
  AlertHelper::showAlert('Logout', 'You are successfully logged out.', 'success');
}

$isAnnounced = false;
$isAuthenticated = $studentController->isAuthenticated();


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
      <?php if ($isAuthenticated && $isAnnounced) : ?>

      <?php elseif ($isAuthenticated && !$isAnnounced) : ?>
        <div class="container">
          <div class="col-lg-12 text-center">
            <div class="card shadow-sm border-0 p-4 rounded-3`">
              <div class="card-title">
                <p class="text-danger">QCPR အားစစ်ဆေးရန်အချိန်ကာလကို သက်ဆိုင်ရာ ဆရာ/မများမှ သတ်မှတ်ထားသည့် <br> အချိန်ကာလတွင်ကျောင်းသား/သူများအား အသိပေးသွားမည်ဖြစ်ပါသည်။</p>
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