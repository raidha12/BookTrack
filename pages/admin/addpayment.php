<?php
session_start();
if (!isset($_SESSION['ad_id'])) {
    header('');
}
include "db.php";

// Initialize $new_pay_num to avoid undefined variable warning
$new_pay_num = '';

// Generate the next auto-incrementing member number
$latest_pay_num_query = "SELECT pay_num FROM annual_payment ORDER BY id DESC LIMIT 1";
$latest_pay_num_result = $conn->query($latest_pay_num_query); // Use $conn instead of $mysqli

if ($latest_pay_num_result) {
    $latest_pay_num = $latest_pay_num_result->fetch_assoc();
    $latest_pay_num = $latest_pay_num ? $latest_pay_num['pay_num'] : 'PAY-000';

    $latest_pay_num_parts = explode('-', $latest_pay_num);
    $latest_pay_num_number = isset($latest_pay_num_parts[1]) ? (int) $latest_pay_num_parts[1] : 0;

    $new_pay_num_number = $latest_pay_num_number + 1;
    $new_pay_num = 'PAY-' . sprintf('%03d', $new_pay_num_number);
}


// Fetching admin names
$admin = '';
$sql = "SELECT * FROM `admin`";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $admin .= '<option value="' . htmlspecialchars($row['ad_name']) . '">' . htmlspecialchars($row['ad_name']) . '</option>';
    }
}

// Fetching member names
$users = '';
$sql = "SELECT * FROM `member`";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users .= '<option value="' . htmlspecialchars($row['mbr_name']) . '">' . htmlspecialchars($row['mbr_name']) . '</option>';
    }
}

// Send message 
if (isset($_POST['save'])) {
    $ad_name = $_POST['ad_name'];
    $mbr_name = $_POST['mbr_name'];
    $fee = $_POST['fee'];
    $date = date('Y-m-d'); // Get current date

    // Input validation
    if (empty($ad_name) || empty($mbr_name) || empty($fee)) {
        echo "All fields are required.";
    } else {
        $sql = "INSERT INTO `annual_payment` (pay_num,ad_name, mbr_name, `fee`, `date`) 
                VALUES ('$new_pay_num','$ad_name', '$mbr_name', '$fee', '$date')";
        $resp = $conn->query($sql);

        if ($resp) {
            header("Location: http://localhost/BookTrack/pages/admin/viewpayment.php?msg=Success");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BookTrack | Add Payment</title>
    <link rel="icon" type="image/png" href="../../assets/img/BookTrack.png">

    <!-- header -->
    <?php include 'templates/header.php'; ?>
</head>

<!-- Navbar -->
<?php include 'templates/nav.php'; ?>

<!-- Sidebar -->
<?php include 'templates/sidebar.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Payment</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Add Payment</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Add Payment</h3>
                            </div>
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="pay_num">Payment Number</label>
                                        <input type="text" name="pay_num" class="form-control" value="<?php echo htmlspecialchars($new_pay_num); ?>" disabled>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleSelectRounded0">Admin Name</label>
                                        <select class="custom-select rounded-0" name="ad_name" required>
                                            <?php echo $admin; ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleSelectRounded0">Member Name</label>
                                        <select class="custom-select rounded-0" name="mbr_name" required>
                                            <?php echo $users; ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="fee">Annual Fees</label>
                                        <input type="text" name="fee" class="form-control" id="fee" required>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-outline-primary" name="save">Add</button>
                                </div>
                            </form>
                        </div>
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

<!-- Footer -->
<?php include 'templates/footer.php'; ?>

<!-- Script -->
<?php include 'templates/script.php'; ?>
</body>

</html>