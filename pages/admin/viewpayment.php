<?php
session_start();
if (!isset($_SESSION['ad_id'])) {
    header('');
}
include "db.php";

//annual_payment
$annual_payment = '';

$sql = " SELECT * FROM `annual_payment` WHERE id=id";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row

    while ($row = $result->fetch_assoc()) {

        $annual_payment .= '<tr><td>' . $row['id'] . '</td>
        <td>' . $row['pay_num'] . '</td>
        <td>' . $row['ad_name'] . '</td>
    <td>' . $row['mbr_name'] . '</td>
    <td>' . $row['fee'] . '</td>
    <td>' . $row['date'] . '</td>
    
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
    <title>BookTrack | View Annual Payment</title>
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
                    <h1>View Annual Payment</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">View Annual Payment</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class="container">
        <div class="row">
            <div class="col-6"></div>
            <div class="col-5">
                <?php

                if (isset($_GET['msg']) && $_GET['msg'] == 'Success') {
                    echo '<div class="alert alert-success alert-dismissible">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
<i class="icon fas fa-check"></i> annual_payment has been sent successfully! </div>';
                }
                ?>
            </div>
            <div class="col-1"></div>
        </div>

    </div>


    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-12">
                <div class="card">

                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Payment Number</th>
                                    <th>Admin</th>
                                    <th>Member</th>
                                    <th>Annual Fees</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php echo $annual_payment; ?>

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