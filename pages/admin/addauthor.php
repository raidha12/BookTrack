<?php
session_start();
if (!isset($_SESSION['ad_id'])) {
    header('');
}
include 'db.php';

// add author
if (isset($_POST['add'])) {
    $au_name = $_POST['au_name'];
    $status = $_POST['status'];

    $image = $_FILES["image"]["name"];
    $target_dir = "assets/img/author/";
    $target_file = $target_dir . basename($image);

    // Upload image to the server
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    $sql = "INSERT INTO `author`(`au_name`, `image`, `status`) 
    VALUES ('$au_name', '$target_file','$status')";

    $resp = $conn->query($sql);
    if ($resp)
        header("Location:http://localhost/BookTrack/pages/admin/viewauthor.php?add=Success");
    else
        header("Location:http://localhost/BookTrack/pages/admin/viewauthor.php?add=Error");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BookTrack | Add Author</title>
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
                        <li class="breadcrumb-item active">View Author</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Add Author</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="" method="post" enctype="multipart/form-data">

                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputTitle">Author</label>
                                        <input type="text" name="au_name" class="form-control" id="au_name" placeholder="Enter">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">Author image</label>
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
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                </div>
                <!-- /.row -->
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

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