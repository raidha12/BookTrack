<?php
session_start();
if (!isset($_SESSION['ad_id'])) {
    header('');
}
include "db.php";

//member
$member = '';

$sql = "SELECT * FROM `member`";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {

        $member .= '<option value="' . $row['mbr_name'] . '" >' . $row['mbr_name'] . '</option>';
    }
}

//admin
$admin = '';

$sql = "SELECT * FROM `admin`";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {

        $admin .= '<option value="' . $row['ad_name'] . '" >' . $row['ad_name'] . '</option>';
    }
}


// send message 
if (isset($_POST['save'])) {
    $mbr_name = $_POST['mbr_name'];
    $ad_name = $_POST['ad_name'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $date = date('Y-m-d'); // Get current date


    $sql = "INSERT INTO `st_message`(mbr_name, ad_name, `subject`, `message` , `date`) 
  VALUES ('$mbr_name','$ad_name','$subject','$message','$date')";
    $resp = $conn->query($sql);
    if ($resp == TRUE) {

        $last_id = $conn->insert_id;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
     if ($resp)
     header("Location:http://localhost/BookTrack/pages/user/viewmessage.php?msg=Success");
  
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BookTrack | Send Message</title>
    <link rel="icon" type="image/png" href="../../assets/img/BookTrack.png">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="../../plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.min.css">
</head>

<!-- Navbar -->
<?php include 'templates/nav.php'; ?>
<!-- /.navbar -->

<!-- Sidebar -->
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
                        <li class="breadcrumb-item active">Send Message</li>
                    </ol>
                </div>
            </div>
        </div>
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
                                <h3 class="card-title">Send Message</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="" method="post" enctype="multipart/form-data">

                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleSelectRounded0">To</label>
                                        <select class="custom-select rounded-0" name="ad_name">
                                            <?php echo $admin; ?>
                                        </select>
                                    </div>


                                    <div class="form-group">
                                        <label for="exampleSelectRounded0">From</label>
                                        <input class="form-control" name="mbr_name" value="<?php echo $_SESSION['mbr_name']; ?>" 
                                        <?php if(isset($_SESSION['mbr_name'])) echo 'readonly'; ?>>
                                    </div>



                                    <div class="form-group">
                                        <label for="subject">Subject</label>
                                        <input type="text" name="subject" class="form-control" id="subject" placeholder="Enter Title">
                                    </div>
                                    <div class="form-group">
                                        <label for="message">Message</label>
                                        <textarea name="message" class="form-control" id="message" rows="2" cols="140"></textarea>

                                    </div>


                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-outline-primary" name="save">Send</button>
                                    
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
                <!-- /.card -->
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
<?php include '../admin/templates/footer.php'; ?>

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