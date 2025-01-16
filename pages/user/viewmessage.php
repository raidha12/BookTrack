<?php
session_start();
if (!isset($_SESSION['mbr_id'])) {
    header('');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BookTrack | View Message</title>
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
                    <h1>View Message</h1>
                </div>



                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">View Message</li>

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

                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Admin</th>
                                    <th>Subject</th>
                                    <th>Message</th>
                                    <th>Date</th>



                                </tr>
                            </thead>
                            <tbody>

                            <?php
                                $link=mysqli_connect("localhost","root","","lms");
                                $res=mysqli_query($link, "SELECT * FROM `st_message` WHERE 
                                mbr_name='$_SESSION[mbr_name]' ORDER BY st_msg_id DESC ");
                                while ($row=mysqli_fetch_array($res)){
                                    $res1=mysqli_query($link, "SELECT * FROM `admin` WHERE 
                                    ad_name='$row[ad_name]' ");
                                    while ($row1=mysqli_fetch_array($res1)){
                                        $ad_name=$row1["ad_name"];
                                }
                                    echo"<tr>";
                                    echo"<td>"; echo $ad_name; echo"</td>";
                                    echo"<td>"; echo $row["subject"]; echo"</td>";
                                    echo"<td>"; echo $row["message"]; echo"</td>";
                                    echo"<td>"; echo $row["date"]; echo"</td>";
                                    echo"</tr>";

                                }
                                ?>
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