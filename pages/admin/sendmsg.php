<?php
session_start();
if (!isset($_SESSION['member_id'])) {
    header('');
}
include "db.php";

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
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $date = date('Y-m-d'); // Get current date

    // Input validation
    if (empty($ad_name) || empty($mbr_name) || empty($subject) || empty($message)) {
        echo "All fields are required.";
    } else {
        $sql = "INSERT INTO `message` (ad_name, mbr_name, `subject`, `message`, `date`) 
                VALUES ('$ad_name', '$mbr_name', '$subject', '$message', '$date')";
        $resp = $conn->query($sql);
        
        if ($resp) {
            header("Location: http://localhost/BookTrack/pages/admin/viewmsg.php?msg=Success");
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
    <title>BookTrack | Send Message</title>
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
                    <h1>Send Message</h1>
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
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Send Message</h3>
                            </div>
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleSelectRounded0">From</label>
                                        <select class="custom-select rounded-0" name="ad_name" required>
                                            <?php echo $admin; ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleSelectRounded0">To</label>
                                        <select class="custom-select rounded-0" name="mbr_name" required>
                                            <?php echo $users; ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="subject">Subject</label>
                                        <input type="text" name="subject" class="form-control" id="subject" placeholder="Enter Title" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="message">Message</label>
                                        <textarea name="message" class="form-control" id="message" rows="2" cols="140" required></textarea>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-outline-primary" name="save">Send</button>
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