<?php

session_start();

if (!isset($_SESSION['ad_name'])) {
  header("Location:login_ad.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BookTrack | Dashboard</title>
  <link rel="icon" type="image/png" href="../../assets/img/BookTrack.png">

 <!-- header -->
 <?php include 'templates/header.php'; ?>
</head>

<body>
  <!-- Navbar -->
  <?php include 'templates/nav.php'; ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include 'templates/sidebar.php'; ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
            Welcome to Admin Dashboard !
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-regular fa-user"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Registered Admins </span>
                <span class="info-box-number">
                  <?php include 'counters/total_admin.php' ?>
                </span>
              </div>
            </div>
          </div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-light fa-users"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Registered Students</span>
                <span class="info-box-number">
                  <?php include 'counters/total_students.php' ?>
                </span>
              </div>
            </div>
          </div>

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-info elevation-1"><i class="nav-icon fas fa-thin fa-book-open"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Total Books </span>
                <span class="info-box-number">
                  <?php include 'counters/total_books.php' ?>
                </span>
              </div>
            </div>
          </div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-light fa-pen"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Total Authors</span>
                <span class="info-box-number">
                  <?php include 'counters/total_author.php' ?>
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-thin fa-bars"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Book Categories</span>
                <span class="info-box-number">
                  <?php include 'counters/total_category.php' ?>
                </span>
              </div>
            </div>
          </div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-solid fa-check"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Books Issued</span>
                <span class="info-box-number">
                  <?php include 'counters/total_issue_book.php' ?>
                </span>
              </div>
            </div>
          </div>

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-envelope"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Messages</span>
                <span class="info-box-number">
                  <?php include 'counters/total_message.php' ?>
                </span>
              </div>
            </div>
          </div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-solid fa-calendar-check"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Latest Books</span>
                <span class="info-box-number">
                  <?php include 'counters/total_latest.php' ?>
                </span>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  
<!-- Footer -->
<?php include 'templates/footer.php'; ?>

<!-- Script -->
<?php include 'templates/script.php'; ?>
</body>

</html>