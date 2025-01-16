<?php
session_start();
if (!isset($_SESSION['ad_name'])) {
  header('Location: login.php'); // Redirect to login page if not authenticated
  exit();
}
include "db.php"; // Ensure this file contains the correct database connection

// Fetch all members from the database
$members_query = "SELECT * FROM member";
$members_result = $conn->query($members_query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BookTrack | View Members</title>
  <link rel="icon" type="image/png" href="../../assets/img/BookTrack.png">

  <!-- header -->
  <?php include 'templates/header.php'; ?>
</head>

<!-- Navbar -->
<?php include 'templates/nav.php'; ?>

<!-- Main Sidebar Container -->
<?php include 'templates/sidebar.php'; ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>View Members</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">View Members</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="card card-solid">
      <div class="card-body pb-0">
        <div class="row">
          <?php if ($members_result->num_rows > 0): ?>
            <?php while ($member = $members_result->fetch_assoc()): ?>
              <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                <div class="card bg-light d-flex flex-fill">
                  <div class="card-header text-muted border-bottom-0">
                    <!-- Member Details -->
                  </div>
                  <div class="card-body pt-0">
                    <h1 class="lead text-center"><b><?php echo htmlspecialchars($member['mbr_name']); ?></b></h1>
                    <div class="row">
                      <div class="col-12">
                        <div class="text-center pb-2">
                          <?php
                          // Set the image path
                          $imagePath = "../../" . htmlspecialchars($member['image']);
                          ?>
                          <img src="<?php echo $imagePath; ?>" alt="user-avatar" class="img-circle img-fluid" style="width: 120px; height: 120px;"  onerror="this.onerror=null; this.src='../../dist/img/default-avatar.png';">
                        </div>
                        <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small pb-2">
                            <span class="fa-li"><i class="fas fa-lg fa-id-card" style="padding-right: 10px;"></i></span>
                            <b>Member ID: </b><?php echo htmlspecialchars($member['mbr_number']); ?>
                          </li>
                         <li class="small pb-2">
                            <span class="fa-li"><i class="fas fa-lg fa-calendar" style="padding-right: 10px;"></i></span>
                            <b>Age: </b> <?php echo htmlspecialchars($member['age']); ?>
                          </li>
                          <li class="small pb-2">
                            <span class="fa-li"><i class="fas fa-lg fa-user" style="padding-right: 10px;"></i></span>
                            <b>Gender: </b> <?php echo htmlspecialchars($member['gender']); ?>
                          </li>
                          <li class="small pb-2">
                            <span class="fa-li"><i class="fas fa-lg fa-phone" style="padding-right: 10px;"></i></span>
                            <b>Phone No: </b><?php echo htmlspecialchars($member['moblie_no']); ?>
                          </li>
                          <li class="small pb-2">
                            <span class="fa-li"><i class="fas fa-lg fa-envelope" style="padding-right: 10px;"></i></span>
                            <b>Email: </b><?php echo htmlspecialchars($member['email']); ?>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="text-right">
                      <a href="view_memberdetails.php?mbr_id=<?php echo urlencode($member['mbr_id']); ?>" class="btn btn-sm btn-primary">
                        <i class="fas fa-user"></i> View Profile
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            <?php endwhile; ?>
          <?php else: ?>
            <div class="col-12">
              <p>No members found.</p>
            </div>
          <?php endif; ?>
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

<?php include 'templates/footer.php'; ?>
<?php include 'templates/script.php'; ?>
</body>

</html>
