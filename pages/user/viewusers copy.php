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
mysqli_close($link);

if (isset($_POST['update'])) {
    $mbr_id = $_POST['mbr_id'];
    $mbr_name = $_POST['mbr_name'];
    $email = $_POST['email'];
    $moblie_no = $_POST['moblie_no'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];

    $image = $_FILES["image"]["name"];
    $target_dir = "assets/img/member/";
    $target_file = $target_dir . basename($image);

    // Check if the directory exists, if not create it
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }

    // Upload image to the server
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        // Prepare the SQL statement
        $stmt = $link->prepare("UPDATE member SET mbr_name = ?, email = ?, moblie_no = ?, gender = ?, age = ? WHERE mbr_id = ?");
        $stmt->bind_param("ssssii", $mbr_name, $email, $moblie_no, $gender, $age, $mbr_id);

        if ($stmt->execute()) {
            header("Location: http://localhost/BookTrack/pages/admin/viewusers.php?update=Success");
        } else {
            header("Location: http://localhost/BookTrack/pages/admin/viewusers.php?update=Error");
        }
        $stmt->close();
    } else {
        header("Location: http://localhost/BookTrack/pages/admin/viewusers.php?update=FileUploadError");
    }
}

if (isset($_GET['mbr_id'])) {
    $mbr_id = $_GET['mbr_id'];
    $result = mysqli_query($link, "SELECT * FROM member WHERE mbr_id= " . $mbr_id);
    $row = $result->fetch_array();
    if (count($row) == 1) {
        $inpmbr_name =  $row['mbr_name'];
        $inpemail =  $row['email'];
        $inpmoblie_no =  $row['moblie_no'];
        $inpgender =  $row['gender'];
        $inpage = $row['age'];
        $current_image = $row['image']; // Store current image path
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <mbr_name>BookTrack | View member</mbr_name>

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
                                    <img src="<?php echo $imagePath; ?>" alt="user-avatar" class="img-circle img-fluid" style="width: 100px; height: 100px;" onerror="this.onerror=null; this.src='../../dist/img/default-avatar.png';">
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

                    <!-- Other Dashboard Content -->
                    <div class="col-9">
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Edit Profile</h3>
                                </div>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="mbr_name">Member Name</label>
                                            <input type="text" name="mbr_name" class="form-control" value='<?php echo isset($row['mbr_name']) ? htmlspecialchars($row['mbr_name']) : ''; ?>'>
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" class="form-control" value='<?php echo isset($row['email']) ? htmlspecialchars($row['email']) : ''; ?>' disabled>
                                        </div>

                                        <div class="form-group">
                                            <label for="moblie_no">Mobile No</label>
                                            <input type="text" name="moblie_no" class="form-control" value='<?php echo isset($row['moblie_no']) ? htmlspecialchars($row['moblie_no']) : ''; ?>'>
                                        </div>


                                        <div class="form-group">
                                            <label for="status">Gender</label>
                                            <select class="custom-select rounded-1" name="gender" style="width: 100%;">
                                                <option value="Male" <?php echo (isset($row['gender']) && $row['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                                                <option value="Female" <?php echo (isset($row['gender']) && $row['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="age">Age</label>
                                            <input type="text" name="age" class="form-control" value='<?php echo isset($row['age']) ? htmlspecialchars($row['age']) : ''; ?>'>
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
            </div>
        </section>
    </div>

    <!-- Footer -->
    <?php include 'templates/footer.php'; ?>

    <!-- Scripts -->
    <?php include 'templates/script.php'; ?>
</body>

</html>