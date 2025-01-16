<?php
session_start();
if (!isset($_SESSION['ad_name'])) {
    header('Location: login.php'); // Redirect to login page if not authenticated
    exit();
}

include "db.php"; // Ensure this file contains the correct database connection

// Initialize $new_mbr_number to avoid undefined variable warning
$new_mbr_number = '';

// Generate the next auto-incrementing member number
$latest_mbr_number_query = "SELECT mbr_number FROM member ORDER BY mbr_id DESC LIMIT 1";
$latest_mbr_number_result = $conn->query($latest_mbr_number_query); // Use $conn instead of $mysqli

if ($latest_mbr_number_result) {
    $latest_mbr_number = $latest_mbr_number_result->fetch_assoc();
    $latest_mbr_number = $latest_mbr_number ? $latest_mbr_number['mbr_number'] : 'MBR-000';

    $latest_mbr_number_parts = explode('-', $latest_mbr_number);
    $latest_mbr_number_number = isset($latest_mbr_number_parts[1]) ? (int) $latest_mbr_number_parts[1] : 0;

    $new_mbr_number_number = $latest_mbr_number_number + 1;
    $new_mbr_number = 'MBR-' . sprintf('%03d', $new_mbr_number_number);
}

// Check if the form is submitted
if (isset($_POST['submit'])) {
    $mbr_name = $_POST['mbr_name'];
    $email = $_POST['email'];
    $moblie_no = $_POST['moblie_no'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];

    $image = $_FILES["image"]["name"];
    $target_dir = "assets/img/member/";
    $target_file = $target_dir . basename($image);

    // Upload image to the server
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    // Insert member data into the database
    $sql = "INSERT INTO member(mbr_number, mbr_name, email, moblie_no, gender, age,`image`) 
            VALUES ('$new_mbr_number', '$mbr_name', '$email', '$moblie_no', '$gender', '$age', '$target_file')";

    $resp = $conn->query($sql);

    // Redirect based on success or failure of the query
    if ($resp) {
        header("Location: http://localhost/BookTrack/pages/admin/viewmember.php?add=Success");
        exit();
    } else {
        header("Location: http://localhost/BookTrack/pages/admin/viewmember.php?add=Error");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BookTrack | Add Member</title>
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
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add New Member</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Add Member</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add New Member</h3>
                        </div>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="mbr_number">Member Number</label>
                                    <input type="text" name="mbr_number" class="form-control" value="<?php echo htmlspecialchars($new_mbr_number); ?>" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="mbr_name">Member Name</label>
                                    <input type="text" name="mbr_name" class="form-control" id="mbr_name" placeholder="">
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" id="email" placeholder="">
                                </div>

                                <div class="form-group">
                                    <label for="moblie_no">Mobile No</label>
                                    <input type="text" name="moblie_no" class="form-control" id="moblie_no" placeholder="">
                                </div>

                              
                                <div class="form-group">
                                    <label for="status">Gender</label>
                                    <select class="custom-select rounded-1" name="gender" style="width: 100%;">
                                        <option selected="selected">Male</option>
                                        <option>Female</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="age">Age</label>
                                    <input type="text" name="age" class="form-control" id="age" placeholder="">
                                </div>

                                <div class="form-group">
                                        <label for="exampleInputFile">Profile Picture</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="form-control" name="image" accept="image/*">
                                            </div>
                                        </div>
                                    </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-outline-primary" name="submit">Add</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>

<?php include 'templates/footer.php'; ?>
<?php include 'templates/script.php'; ?>
</body>

</html>