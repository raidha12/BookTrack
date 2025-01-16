<?php
session_start();
if (!isset($_SESSION['ad_id'])) {
    header('');
}
include "db.php";


//category
$category = '';

$sql = " SELECT * FROM category WHERE cat_id=cat_id";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row

    while ($row = $result->fetch_assoc()) {
        $imagePath = "../../" . $row['image'];
        $category .= '<tr><td>' . $row['cat_id'] . '</td>
        <td>' . $row['cat_name'] . '</td>
        <td><img src="' . $imagePath . '" alt="Category Image" width="70" height="100" style="border: 2px solid #dce0e4;"></td>
        <td>' . $row['status'] . '</td>
    
    <td>
    <a href="action/deletecategory.php?cat_id=' . $row['cat_id'] . '"><img src=../../assets\img\delete.png></a>
    </td>
    </tr>';
    }
    //<td>' .  substr($row['description'], 0, 30) . '</td>
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BookTrack | View Category</title>
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
                    <h1>View Category</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">View Category</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!--add,delete-->
    <div class="container">
        <div class="row">
            <div class="col-6"></div>
            <div class="col-5">
                <!--delete-->
                <?php
                if (isset($_GET['msg']) && $_GET['msg'] == 'Success') {
                    echo '<div class="alert alert-success alert-dismissible">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
<i class="icon fas fa-check"></i> Record has been deleted successfully! </div>';
                } else if (isset($_GET['msg']) && $_GET['msg'] == 'Error') {

                    echo '<div class="alert alert-danger alert-dismissible">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
<h5><i class="icon fas fa-check"></i> Error </div>';
                }
                ?>
                <!--add-->
                <?php

                if (isset($_GET['add']) && $_GET['add'] == 'Success') {
                    echo '<div class="alert alert-success alert-dismissible">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
<i class="icon fas fa-check"></i> Record has been added successfully! </div>';
                } else if (isset($_GET['add']) && $_GET['add'] == 'Error') {
 echo '<div class="alert alert-danger alert-dismissible">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
<i class="icon fas fa-check"></i> Error </div>';
                }
                ?>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
    <!--/.add,delete-->



    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Category_Id</th>
                                    <th>Category</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>


                                </tr>
                            </thead>
                            <tbody>
                                <?php echo $category; ?>

                            </tbody>
                        </table>
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