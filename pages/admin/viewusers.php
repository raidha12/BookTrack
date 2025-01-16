<?php
session_start();
if (!isset($_SESSION['ad_id'])) {
    header('');
}
include "db.php";

//users
$users = '';

$sql = " SELECT * FROM users WHERE user_id=user_id";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row

    while ($row = $result->fetch_assoc()) {
       
        $users.= '<tr><td>' . $row['user_id'] . '</td>
        <td>' . $row['mbr_name'] . '</td>
    <td>' . $row['email'] . '</td>
    <td>' . $row['reg_date'] . '</td>
    
    
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
    <title>BookTrack | View Users</title>
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
                    <h1>View Users</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">View Users</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>



    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>User Id</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Reg_Date</th>
                                    
                                    
                                </tr>
                            </thead>
                            <tbody>
                            <?php echo $users; ?>

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