<?php
session_start();
if (!isset($_SESSION['ad_id'])) {
    header('');
}
include "db.php";

//return book
$return_book = '';

$sql = " SELECT * FROM return_book";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row

    while ($row = $result->fetch_assoc()) {

        $return_book .= '<tr><td>' . $row['re_bk_id'] . '</td>
       
        <td>' . $row['mbr_name'] . '</td>
        <td>' . $row['ad_name'] . '</td>
        <td>' . $row['title'] . '</td>
        <td>' . $row['due_date'] . '</td>
        <td>' . $row['return_date'] . '</td>
        <td>' . $row['diff_days'] . '</td>
        <td>' . $row['fine'] . '</td>
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
    <title>BookTrack | View Returned Books</title>
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
                    <h1>View Returned Books</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">View Returned Books</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class="container">
        <div class="row">
            <div class="col-6"></div>
            <div class="col-5">
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
    <!-- /.add-->


    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-12">
                <div class="card">

                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table  table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>User</th>
                                    <th>Admin</th>
                                    <th>Title</th>
                                    <th>Due Date</th>
                                    <th>Returned Date</th>
                                    <th>Different Days</th>
                                    <th>Fine</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php echo $return_book; ?>
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>

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