<?php
session_start();
if (!isset($_SESSION['ad_id'])) {
  header('');
}

$link = mysqli_connect("localhost", "root", "", "lms");

if (isset($_POST['update'])) {
  $book_id = $_POST['book_id'];
  $title = $_POST['title'];
  $au_id = $_POST['au_id'];
  $cat_id = $_POST['cat_id'];
  $publisher = $_POST['publisher'];
  $isbn = $_POST['isbn'];
  $description = $_POST['description'];
  $pages = $_POST['pages'];
  $status = $_POST['status'];

  $image = $_FILES["image"]["name"];
  $target_dir = "assets/img/books/";
  $target_file = $target_dir . basename($image);

  // Check if the directory exists, if not create it
  if (!is_dir($target_dir)) {
    mkdir($target_dir, 0755, true);
  }

  // Upload image to the server
  if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    // Prepare the SQL statement
    $stmt = $link->prepare("UPDATE books SET title = ?, au_id = ?, cat_id = ?, publisher = ?, isbn = ?, description = ?, pages = ?, image = ?, status = ? WHERE book_id = ?");
    $stmt->bind_param("siissssssi", $title, $au_id, $cat_id, $publisher, $isbn, $description, $pages, $target_file, $status, $book_id);

    if ($stmt->execute()) {
      header("Location: http://localhost/BookTrack/pages/admin/viewbook.php?update=Success");
    } else {
      header("Location: http://localhost/BookTrack/pages/admin/viewbook.php?update=Error");
    }
    $stmt->close();
  } else {
    header("Location: http://localhost/BookTrack/pages/admin/viewbook.php?update=FileUploadError");
  }
}

if (isset($_GET['book_id'])) {
  $book_id = $_GET['book_id'];
  $result = mysqli_query($link, "SELECT * FROM books WHERE book_id= " . $book_id);
  $row = $result->fetch_array();
  if (count($row) == 1) {
    $inptitle =  $row['title'];
    $inpau_id =  $row['au_id'];
    $inpcat_id =  $row['cat_id'];
    $inppublisher =  $row['publisher'];
    $inpisbn = $row['isbn'];
    $inpdescription = $row['description'];
    $inppages = $row['pages'];
    $inpstatus =  $row['status'];
    $current_image = $row['image']; // Store current image path
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BookTrack | Edit Book</title>
  <link rel="icon" type="image/png" href="../../assets/img/BookTrack.png">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="../../../plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="../../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <link rel="stylesheet" href="../../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="../../../plugins/jqvmap/jqvmap.min.css">
  <link rel="stylesheet" href="../../../dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="../../../plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="../../../plugins/summernote/summernote-bs4.min.css">
</head>

<body>
  <!-- Navbar -->
  <?php include '../templates/nav.php'; ?>
  <!-- /.navbar -->
  <?php
  $current_page = basename($_SERVER['PHP_SELF']);
  ?>

  <aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Brand Logo -->
    <a href="dashboard.php" class="brand-link">
      <img src="../../../assets/img/Book Track.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
      <span class="brand-text font-weight-light">Book Track Pro</span>
    </a>




    <div class="sidebar">
      <br>
      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <!-- Dashboard -->
          <li class="nav-item">
            <a href="../dashboard.php" class="nav-link <?php echo ($current_page == '../dashboard.php') ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>

          <!-- Books -->
          <li class="nav-item <?php echo ($current_page == '../addbook.php' || $current_page == '../viewbook.php') ? 'menu-open' : ''; ?>">
            <a href="#" class="nav-link <?php echo ($current_page == '../addbook.php' || $current_page == '../viewbook.php') ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-book-open"></i>
              <p>
                Books
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../addbook.php" class="nav-link <?php echo ($current_page == '../addbook.php') ? 'active' : ''; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Book</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../viewbook.php" class="nav-link <?php echo ($current_page == '../viewbook.php') ? 'active' : ''; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Book</p>
                </a>
              </li>
            </ul>
          </li>

          <!--Latest Books -->
          <li class="nav-item <?php echo ($current_page == '../addlatestbook.php' || $current_page == '../viewlatestbook.php') ? 'menu-open' : ''; ?>">
            <a href="#" class="nav-link <?php echo ($current_page == '../addlatestbook.php' || $current_page == '../viewlatestbook.php') ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-book-open"></i>
              <p>
                Latest Books
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../addlatestbook.php" class="nav-link <?php echo ($current_page == '../addlatestbook.php') ? 'active' : ''; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Latest Book</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../viewlatestbook.php" class="nav-link <?php echo ($current_page == '../viewlatestbook.php') ? 'active' : ''; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Latest Book</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- Author -->
          <li class="nav-item <?php echo ($current_page == '../addauthor.php' || $current_page == '../viewauthor.php') ? 'menu-open' : ''; ?>">
            <a href="#" class="nav-link <?php echo ($current_page == '../addauthor.php' || $current_page == '../viewauthor.php') ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-pen"></i>
              <p>
                Author
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../addauthor.php" class="nav-link <?php echo ($current_page == '../addauthor.php') ? 'active' : ''; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Author</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../viewauthor.php" class="nav-link <?php echo ($current_page == '../viewauthor.php') ? 'active' : ''; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Author</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- Category -->
          <li class="nav-item <?php echo ($current_page == '../addcategory.php' || $current_page == '../viewcategory.php') ? 'menu-open' : ''; ?>">
            <a href="#" class="nav-link <?php echo ($current_page == '../addcategory.php' || $current_page == '../viewcategory.php') ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-bars"></i>
              <p>
                Category
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../addcategory.php" class="nav-link <?php echo ($current_page == '../addcategory.php') ? 'active' : ''; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../viewcategory.php" class="nav-link <?php echo ($current_page == '../viewcategory.php') ? 'active' : ''; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Category</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- Issued Books -->
          <li class="nav-item <?php echo ($current_page == '../add_is_bk.php' || $current_page == '../view_is_bk.php') ? 'menu-open' : ''; ?>">
            <a href="#" class="nav-link <?php echo ($current_page == '../add_is_bk.php' || $current_page == '../view_is_bk.php') ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-solid fa-check"></i>
              <p>
                Issued Books
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../add_is_bk.php" class="nav-link <?php echo ($current_page == '../add_is_bk.php') ? 'active' : ''; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Issued Book</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../view_is_bk.php" class="nav-link <?php echo ($current_page == '../view_is_bk.php') ? 'active' : ''; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Issued Book</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- Returned Books -->
          <li class="nav-item <?php echo ($current_page == '../add_ret_bk.php' || $current_page == '../view_ret_bk.php') ? 'menu-open' : ''; ?>">
            <a href="#" class="nav-link <?php echo ($current_page == '../add_ret_bk.php' || $current_page == '../view_ret_bk.php') ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-solid fa-calendar-check"></i>
              <p>
                Returned Books
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../add_ret_bk.php" class="nav-link <?php echo ($current_page == '../add_ret_bk.php') ? 'active' : ''; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Returned Book</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../view_ret_bk.php" class="nav-link <?php echo ($current_page == '../view_ret_bk.php') ? 'active' : ''; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Returned Book</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- Reserve Book -->
          <li class="nav-item">
            <a href="../reservebook.php" class="nav-link <?php echo ($current_page == '../reservebook.php') ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-book-open"></i>
              <p>Reserve Book</p>
            </a>
          </li>

          <!-- Messages -->
          <li class="nav-item <?php echo ($current_page == '../sendmsg.php' || $current_page == '../viewmsg.php' || $current_page == 'viewmsgst.php') ? 'menu-open' : ''; ?>">
            <a href="#" class="nav-link <?php echo ($current_page == '../sendmsg.php' || $current_page == '../viewmsg.php' || $current_page == 'viewmsgst.php') ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-envelope"></i>
              <p>
                Messages
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../sendmsg.php" class="nav-link <?php echo ($current_page == '../sendmsg.php') ? 'active' : ''; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Message</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../viewmsg.php" class="nav-link <?php echo ($current_page == '../viewmsg.php') ? 'active' : ''; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Admin Message</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../viewmsgst.php" class="nav-link <?php echo ($current_page == '../viewmsgst.php') ? 'active' : ''; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Member Message</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- Membership -->
          <li class="nav-item <?php echo ($current_page == '../addmember.php' || $current_page == '../viewmember.php') ? 'menu-open' : ''; ?>">
            <a href="#" class="nav-link <?php echo ($current_page == '../addmember.php' || $current_page == '../viewmember.php') ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-light fa-id-card"></i>
              <p>
                Membership
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../add_member.php" class="nav-link <?php echo ($current_page == '../add_member.php') ? 'active' : ''; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Member</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../viewmember.php" class="nav-link <?php echo ($current_page == '../viewmember.php') ? 'active' : ''; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Member</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- Payement -->
          <li class="nav-item <?php echo ($current_page == '../addpayment.php' || $current_page == '../viewpayment.php') ? 'menu-open' : ''; ?>">
            <a href="#" class="nav-link <?php echo ($current_page == '../addpayment.php' || $current_page == '../viewpayment.php') ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-dollar-sign"></i>
              <p>
                Annual Payment
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../addpayment.php" class="nav-link <?php echo ($current_page == '../addpayment.php') ? 'active' : ''; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Payment</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../viewpayment.php" class="nav-link <?php echo ($current_page == '../viewpayment.php') ? 'active' : ''; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Payment</p>
                </a>
              </li>
            </ul>
          </li>

        </ul>
      </nav>
    </div>
  </aside>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Book</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Edit Book</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- form start -->
    <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="book_id" value="<?php echo isset($book_id) ? $book_id : ''; ?>">

      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Edit Book</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="form-group">
                    <label for="title">Title</label>
                    <input type='text' name='title' value='<?php echo isset($row['title']) ? htmlspecialchars($row['title']) : ''; ?>' class='form-control' placeholder=''>
                  </div>

                  <div class="form-group">
                    <label for="exampleSelectRounded0">Author</label>
                    <select name="au_id" class="custom-select rounded-1">
                      <?php
                      $res = mysqli_query($link, "SELECT * FROM author");
                      while ($row1 = mysqli_fetch_array($res)) {
                        echo "<option value='" . $row1["au_id"] . "'" . (isset($row['au_id']) && $row['au_id'] == $row1['au_id'] ? " selected" : "") . ">" . $row1["au_id"] . "(" . $row1["au_name"] . ")</option>";
                      }
                      ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="exampleSelectRounded0">Category</label>
                    <select name="cat_id" class="custom-select rounded-1">
                      <?php
                      $res = mysqli_query($link, "SELECT * FROM category");
                      while ($row1 = mysqli_fetch_array($res)) {
                        echo "<option value='" . $row1["cat_id"] . "'" . (isset($row['cat_id']) && $row['cat_id'] == $row1['cat_id'] ? " selected" : "") . ">" . $row1["cat_id"] . "(" . $row1["cat_name"] . ")</option>";
                      }
                      ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="publisher">Publisher</label>
                    <input type='text' name='publisher' value='<?php echo isset($row['publisher']) ? htmlspecialchars($row['publisher']) : ''; ?>' class='form-control' placeholder=''>
                  </div>

                  <div class="form-group">
                    <label for="isbn">ISBN</label>
                    <input type='text' name='isbn' value='<?php echo isset($row['isbn']) ? htmlspecialchars($row['isbn']) : ''; ?>' class='form-control' placeholder=''>
                  </div>

                  <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class='form-control' rows='3' name='description' placeholder=''><?php echo isset($row['description']) ? htmlspecialchars($row['description']) : ''; ?></textarea>
                  </div>

                  <div class="form-group">
                    <label for="pages">Pages</label>
                    <input type='text' name='pages' value='<?php echo isset($row['pages']) ? htmlspecialchars($row['pages']) : ''; ?>' class='form-control' placeholder=''>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputFile">Book Image</label>
                    <div class="profile-upload">
                      <div class="upload-img">
                        <!-- Display the current image -->
                        <img src="<?php echo isset($row['image']) ? htmlspecialchars($row['image']) : 'default-image-path.jpg'; ?>" alt="Book Image" style="max-width: 150px; max-height: 150px;">
                      </div>
                      <div class="upload-input">
                        <!-- Display the current image name -->
                        <p><?php echo isset($row['image']) ? basename($row['image']) : 'No image uploaded'; ?></p>
                        <input type="file" name="image" class="form-control">
                      </div>
                    </div>
                  </div>


                  <div class="form-group">
                    <label for="exampleSelectRounded0">Status</label>
                    <select class="custom-select rounded-1" name="status" style="width: 100%;">
                      <option value="Available" <?php echo (isset($row['status']) && $row['status'] == 'Available') ? 'selected' : ''; ?>>Available</option>
                      <option value="Unavailable" <?php echo (isset($row['status']) && $row['status'] == 'Unavailable') ? 'selected' : ''; ?>>Unavailable</option>
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="update">Update</button>
                </div>
              </div>
              <!-- /.card -->
            </div>
            <!--/.col (left) -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </form>
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <?php include '../templates/footer.php'; ?>
  <!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../../plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../../plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../../plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../../plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../../plugins/moment/moment.min.js"></script>
<script src="../../plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../../plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.js"></script>
</body>

</html>