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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BookTrack | Dashboard</title>
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
                        <h1 class="m-0">Dashboard</h1>
                        Welcome to User Dashboard!
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
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
                        <!-- Borrowed Books Card -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Borrowed Books</h3>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Admin</th>
                                            <th>Lent Book</th>
                                            <th>Lent Date</th>
                                            <th>Due Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $link = mysqli_connect("localhost", "root", "", "lms");
                                        $res = mysqli_query($link, "SELECT * FROM `issue_book` WHERE mbr_name='$_SESSION[mbr_name]' ORDER BY is_bk_id DESC");
                                        while ($row = mysqli_fetch_array($res)) {
                                            $res1 = mysqli_query($link, "SELECT * FROM `admin` WHERE ad_name='$row[ad_name]'");
                                            while ($row1 = mysqli_fetch_array($res1)) {
                                                $ad_name = $row1["ad_name"];
                                            }
                                            echo "<tr>";
                                            echo "<td>$ad_name</td>";
                                            echo "<td>{$row["title"]}</td>";
                                            echo "<td>{$row["issue_date"]}</td>";
                                            echo "<td>{$row["due_date"]}</td>";
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Annual Payment Card -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Annual Payment</h3>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Payment Number</th>
                                            <th>Admin</th>
                                            <th>Annual Fees</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $res = mysqli_query($link, "SELECT * FROM `annual_payment` WHERE mbr_name='$_SESSION[mbr_name]' ORDER BY id DESC");
                                        while ($row = mysqli_fetch_array($res)) {
                                            $res1 = mysqli_query($link, "SELECT * FROM `admin` WHERE ad_name='$row[ad_name]'");
                                            while ($row1 = mysqli_fetch_array($res1)) {
                                                $ad_name = $row1["ad_name"];
                                            }
                                            echo "<tr>";
                                            echo "<td>{$row["pay_num"]}</td>";
                                            echo "<td>{$row["ad_name"]}</td>";
                                            echo "<td>{$row["fee"]}</td>";
                                            echo "<td>{$row["date"]}</td>";
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                     </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Footer -->
    <?php include '../admin/templates/footer.php'; ?>

    <!-- Scripts -->
    <?php include 'templates/script.php'; ?>
</body>

</html>