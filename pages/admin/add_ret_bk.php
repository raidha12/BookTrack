<?php
session_start();
if (!isset($_SESSION['ad_id'])) {
    header('');
}
include "db.php";
//user 
$mbr_name = '';

$sql = "SELECT * FROM `member`";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        // print_r($row);
        // die;
        $mbr_name .= '<option value="' . $row['mbr_name'] . '" >' . $row['mbr_name'] . '</option>';
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



// return book
if (isset($_POST['add'])) {
    $mbr_name = $_POST['mbr_name'];
    $ad_name = $_POST['ad_name'];
    $title = $_POST['title'];
    $due_date = $_POST['due_date'];
    $return_date = $_POST['return_date'];
    $diff_days = $_POST['diff_days'];
    $fine = $_POST['fine'];



    $sql = ("INSERT INTO return_book(mbr_name,ad_name,title,due_date,return_date,diff_days,fine) 
    VALUES ('$mbr_name','$ad_name','$title', '$due_date','$return_date','$diff_days','$fine')");
    $resp = $conn->query($sql);
    // print_r($sql);
    // die;
    if ($resp == TRUE) {

        $last_id = $conn->insert_id;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    if ($resp)
    header("Location:http://localhost/BookTrack/pages/admin/view_ret_bk.php?add=Success");
  else
    header("Location:http://localhost/BookTrack/pages/admin/view_ret_bk.php?add=Error");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BookTrack | Return Books</title>
    <link rel="icon" type="image/png" href="../../assets/img/BookTrack.png">

    <!-- header -->
    <?php include 'templates/header.php'; ?>
</head>

<body>

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
                            <li class="breadcrumb-item active">Return Book</li>
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
                                    <h3 class="card-title">Return Books</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form action="" method="post" enctype="multipart/form-data">

                                    <div class="card-body">


                                        <label for="exampleSelectRounded0">User</label>
                                        <select class="custom-select rounded-1" name="mbr_name" style="width: 100%;">
                                            <?php echo $mbr_name; ?>
                                        </select>

                                        <label for="exampleSelectRounded0">Admin</label>
                                        <select class="custom-select rounded-1" name="ad_name" style="width: 100%;">
                                            <?php echo $admin; ?>
                                        </select>




                                        <div class="form-group">
                                            <label for="exampleInputTitle">Title</label>
                                            <input type="text" name="title" class="form-control">
                                        </div>
                                        



                                        <div class="row mb-3">
                                            <label for="issue_date" class="col-sm-2 col-form-label">Due Date</label>
                                            <div class="col-sm-10">
                                                <input type="date" name="due_date" id="dateInput1">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="due_date" class="col-sm-2 col-form-label">Returned Date</label>
                                            <div class="col-sm-10">
                                                <input type="date" name="return_date" id="dateInput2">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="diffdays" class="col-sm-2 col-form-label">Different Days</label>
                                            <div class="col-sm-2">
                                                <button type="button" style="width:100px;" class="btn btn-outline-secondary" onclick="daysDifference()">
                                                    Days
                                                </button>
                                            </div>
                                            <div class="col-sm-8">
                                                <input type="text" name="diff_days" id="result" class="form-control" placeholder="Different Days">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="fine" class="col-sm-2 col-form-label">Fine</label>
                                            <div class="col-sm-2">
                                                <button type="button" style="width:100px;" class="btn btn-outline-secondary" onclick="checkResult()">
                                                    Fine
                                                </button>
                                            </div>
                                            <div class="col-sm-8">
                                                <input type="text" name="fine" id="fine" class="form-control" placeholder="Fine">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-outline-primary" name="add">Submit</button>
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

    <!-- return js -->
<script src="../../assets/js/return.js"></script>

<!-- Footer -->
<?php include 'templates/footer.php'; ?>

<!-- Script -->
<?php include 'templates/script.php'; ?>
</body>

</html>