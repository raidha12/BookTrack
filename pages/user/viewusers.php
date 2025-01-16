<?php
session_start();

if (!isset($_SESSION['mbr_name'])) {
    header("Location: login_us.php");
    exit();
}

include "db.php";

// Fetch member details
$link = mysqli_connect("localhost", "root", "", "lms");
if (!$link) {
    die("Database connection failed: " . mysqli_connect_error());
}

$mbr_name = $_SESSION['mbr_name'];
$sql = "SELECT * FROM `member` WHERE `mbr_name` = ?";
$stmt = mysqli_prepare($link, $sql);
mysqli_stmt_bind_param($stmt, "s", $mbr_name);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$member = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    // Handle form submission
    $mbr_id = $_POST['mbr_id'];
    $mbr_name = $_POST['mbr_name'];
    $moblie_no = $_POST['moblie_no'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];

    // Handle file upload
    $image = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = "assets/img/member/" . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $image);
    }

    // Update query
    $sql = "UPDATE `member` SET `mbr_name` = ?, `moblie_no` = ?, `gender` = ?, `age` = ?" . ($image ? ", `image` = ?" : "") . " WHERE `mbr_id` = ?";
    $stmt = mysqli_prepare($link, $sql);

    if ($image) {
        mysqli_stmt_bind_param($stmt, "sssssi", $mbr_name, $moblie_no, $gender, $age, $image, $mbr_id);
    } else {
        mysqli_stmt_bind_param($stmt, "ssssi", $mbr_name, $moblie_no, $gender, $age, $mbr_id);
    }

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success'] = "Member details updated successfully!";
        header("Location: http://localhost/BookTrack/pages/user/viewusers.php");
        exit();
    } else {
        $_SESSION['error'] = "Failed to update member details.";
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BookTrack | View Member</title>
    <link rel="icon" type="image/png" href="../../assets/img/BookTrack.png">

    <!-- Header -->
    <?php include 'templates/header.php'; ?>
</head>

<body>
    <!-- Navbar -->
    <?php include 'templates/nav.php'; ?>

    <!-- Main Sidebar Container -->
    <?php include 'templates/sidebar.php'; ?>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <!-- Content Header -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">View Member</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active">View Member</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="card pt-3 pr-3 pl-3">
                <div class="row">
                    <!-- User Details Card -->
                    <div class="col-md-3">
                        <div class="card bg-light">
                            <div class="card-body pt-2">
                                <h1 class="lead text-center"><b><?php echo htmlspecialchars($member['mbr_name']); ?></b></h1>
                                <div class="text-center pb-2">
                                    <?php
                                    $imagePath = "../../" . htmlspecialchars($member['image']);
                                    ?>
                                    <img src="<?php echo $imagePath; ?>" alt="user-avatar" class="img-circle img-fluid" style="width: 100px; height: 100px;" onerror="this.onerror=null; this.src=' '../../dist/img/default-avatar.png';">
                                </div>
                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                    <li class="small pb-2">
                                        <span class="fa-li"><i class="fas fa-lg fa-id-card" style="padding-right: 10px;"></i></span>
                                        <b>Member ID: </b><?php echo htmlspecialchars($member['mbr_number']); ?>
                                    </li>
                                    <li class="small pb-2">
                                        <span class="fa-li"><i class="fas fa-lg fa-calendar" style="padding-right: 10px;"></i></span>
                                        <b>Age: </b> <?php echo htmlspecialchars($member['age']); ?>
                                    </li>
                                    <li class="small pb-2">
                                        <span class="fa-li"><i class="fas fa-lg fa-user" style="padding-right: 10px;"></i></span>
                                        <b>Gender: </b> <?php echo htmlspecialchars($member['gender']); ?>
                                    </li>
                                    <li class="small pb-2">
                                        <span class="fa-li"><i class="fas fa-lg fa-phone" style="padding-right: 10px;"></i></span>
                                        <b>Phone No: </b><?php echo htmlspecialchars($member['moblie_no']); ?>
                                    </li>
                                    <li class="small pb-2">
                                        <span class="fa-li"><i class="fas fa-lg fa-envelope" style="padding-right: 10px;"></i></span>
                                        <b>Email: </b><?php echo htmlspecialchars($member['email']); ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Other View Member Content -->
                    <div class="col-9">
                        <div class="col-md-12">
                        <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Edit Member Details</h3>
                                </div>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="card-body">
                                        <input type="hidden" name="mbr_id" value="<?php echo htmlspecialchars($member['mbr_id']); ?>">
                                        <div class="form-group">
                                            <label for="mbr_number">Member Number</label>
                                            <input type="text" name="mbr_number" class="form-control" value="<?php echo htmlspecialchars($member['mbr_number']); ?>" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="mbr_name">Member Name</label>
                                            <input type="text" name="mbr_name" class="form-control" id="mbr_name" value="<?php echo htmlspecialchars($member['mbr_name']); ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" class="form-control" id="email" value="<?php echo htmlspecialchars($member['email']); ?>" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="moblie_no">Mobile No</label>
                                            <input type="text" name="moblie_no" class="form-control" id="moblie_no" value="<?php echo htmlspecialchars($member['moblie_no']); ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="gender">Gender</label>
                                            <select class="custom-select rounded-1" name="gender" style="width: 100%;" required>
                                                <option value="Male" <?php echo $member['gender'] === 'Male' ? 'selected' : ''; ?>>Male</option>
                                                <option value="Female" <?php echo $member['gender'] === 'Female' ? 'selected' : ''; ?>>Female</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="age">Age</label>
                                            <input type="number" name="age" class="form-control" id="age" value="<?php echo htmlspecialchars($member['age']); ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="image">Profile Picture (Upload New)</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" name="image" accept="image/*">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary" name="update">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Footer -->
    <?php include 'templates/footer.php'; ?>

    <!-- Scripts -->
    <?php include 'templates/script.php'; ?>
</body>

</html>