<?php
session_start();
if (!isset($_SESSION['ad_id'])) {
  header('');
}
include "db.php";

// Initialize $new_bk_num to avoid undefined variable warning
$new_bk_num = '';

// Generate the next auto-incrementing member number
$latest_bk_num_query = "SELECT bk_num FROM books ORDER BY book_id DESC LIMIT 1";
$latest_bk_num_result = $conn->query($latest_bk_num_query); // Use $conn instead of $mysqli

if ($latest_bk_num_result) {
  $latest_bk_num = $latest_bk_num_result->fetch_assoc();
  $latest_bk_num = $latest_bk_num ? $latest_bk_num['bk_num'] : 'BOK-000';

  $latest_bk_num_parts = explode('-', $latest_bk_num);
  $latest_bk_num_number = isset($latest_bk_num_parts[1]) ? (int) $latest_bk_num_parts[1] : 0;

  $new_bk_num_number = $latest_bk_num_number + 1;
  $new_bk_num = 'BOK-' . sprintf('%03d', $new_bk_num_number);
}


//author
$author = '';

$sql = "SELECT * FROM `author`";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // output data of each row
  while ($row = $result->fetch_assoc()) {

    $author .= '<option value="' . $row['au_id'] . '" >' . $row['au_name'] . '</option>';
  }
}

//category
$category = '';

$sql = "SELECT * FROM `category`";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // output data of each row
  while ($row = $result->fetch_assoc()) {

    $category .= '<option value="' . $row['cat_id'] . '" >' . $row['cat_name'] . '</option>';
  }
}

// add book 
if (isset($_POST['add'])) {
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

  // Upload image to the server
  move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);


  $sql = ("INSERT INTO books(bk_num,title, au_id, cat_id, publisher,isbn,`description`, pages,`image`,`status`) 
  VALUES ('$new_bk_num', '$title','$au_id','$cat_id','$publisher','$isbn', '$description', '$pages', '$target_file','$status')");
  $resp = $conn->query($sql);
  if ($resp == TRUE) {

    $last_id = $conn->insert_id;
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  if ($resp)
    header("Location:http://localhost/BookTrack/pages/admin/viewbook.php?add=Success");
  else
    header("Location:http://localhost/BookTrack/pages/admin/viewbook.php?add=Error");
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BookTrack | Add Book</title>
  <link rel="icon" type="image/png" href="../../assets/img/BookTrack.png">

  <!-- header -->
  <?php include 'templates/header.php'; ?>
</head>


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

        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Add Book</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Add New Books</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="" method="post" enctype="multipart/form-data">

              <div class="card-body">
                <div class="form-group">
                  <label for="bk_num">Book Number</label>
                  <input type="text" name="bk_num" class="form-control" value="<?php echo htmlspecialchars($new_bk_num); ?>" disabled>
                </div>
                <div class="form-group">
                  <label for="title">Title</label>
                  <input type="text" name="title" class="form-control" id="title" placeholder="">
                </div>

                <div class="form-group">
                  <label for="exampleSelectRounded0">Author</label>
                  <select class="custom-select rounded-1" name="au_id" id="$au_id">
                    <?php echo $author; ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="exampleSelectRounded0">Category</label>
                  <select class="custom-select rounded-1" name="cat_id" id="$cat_id">
                    <?php echo $category; ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="publisher">Publisher</label>
                  <input type="text" name="publisher" class="form-control" id="publisher" placeholder="">
                </div>

                <div class="form-group">
                  <label for="isbn">ISBN</label>
                  <input type="text" name="isbn" class="form-control" id="isbn" placeholder="">
                </div>


                <div class="form-group">
                  <label for="description">Description</label>
                  <textarea class="form-control" rows="3" name="description" id="description" placeholder=""></textarea>
                </div>

                <div class="form-group">
                  <label for="pages">Pages</label>
                  <input type="number" name="pages" class="form-control" id="pages" placeholder="">
                </div>

                <div class="form-group">
                  <label for="exampleInputFile">Book Image</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="form-control" name="image" accept="image/*">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleSelectRounded0">Status</label>
                  <select class="custom-select rounded-1" name="status" style="width: 100%;">
                    <option selected="selected">Active</option>
                    <option>De-active</option>
                  </select>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-outline-primary" name="add">Add</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  </section>
</div>


<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->

<!-- ./wrapper -->


<!-- Footer -->
<?php include 'templates/footer.php'; ?>

<!-- Script -->
<?php include 'templates/script.php'; ?>
</body>

</html>