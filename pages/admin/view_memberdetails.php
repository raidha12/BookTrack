<?php
session_start();
if (!isset($_SESSION['ad_name'])) {
    header('Location: login.php'); // Redirect to login page if not authenticated
    exit();
}
include "db.php"; // Ensure this file contains the correct database connection

// Get the member ID from the URL
$mbr_id = isset($_GET['mbr_id']) ? intval($_GET['mbr_id']) : 0;

// Fetch the specific member from the database
$member_query = "SELECT * FROM member WHERE mbr_id = ?";
$stmt = $conn->prepare($member_query);
$stmt->bind_param("i", $mbr_id);
$stmt->execute();
$member_result = $stmt->get_result();
$member = $member_result->fetch_assoc();

// Fetch the borrowed books for the specific member
$books_query = "SELECT * FROM issue_book WHERE mbr_name = ?";
$books_stmt = $conn->prepare($books_query);
$books_stmt->bind_param("s", $member['mbr_name']);
$books_stmt->execute();
$books_result = $books_stmt->get_result();

// Fetch the borrowed payment for the specific member
$payment_query = "SELECT * FROM annual_payment WHERE mbr_name = ?";
$payment_stmt = $conn->prepare($payment_query);
$payment_stmt->bind_param("s", $member['mbr_name']);
$payment_stmt->execute();
$payment_result = $payment_stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BookTrack | View Member Details</title>
    <link rel="icon" type="image/png" href="../../assets/img/BookTrack.png">

    <!-- header -->
    <?php include 'templates/header.php'; ?>
</head>

<!-- Navbar -->
<?php include 'templates/nav.php'; ?>

<!-- Main Sidebar Container -->
<?php include 'templates/sidebar.php'; ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>View Member Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">View Member Profile</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card bg-light">
                            <div class="card-body pt-2">
                                <h1 class="lead text-center"><b><?php echo htmlspecialchars($member['mbr_name']); ?></b></h1>
                                <div class="text-center pb-2">
                                    <?php
                                    // Set the image path
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
                                        <span class="fa-li"><i class="fas fa-lg fa-user " style="padding-right: 10px;"></i></span>
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

                    <div class="col-md-9">
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
                                        <?php while ($book = $books_result->fetch_assoc()): ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($book['ad_name']); ?></td>
                                                <td><?php echo htmlspecialchars($book['title']); ?></td>
                                                <td><?php echo htmlspecialchars($book['issue_date']); ?></td>
                                                <td><?php echo htmlspecialchars($book['due_date']); ?></td>
                                            </tr>
                                        <?php endwhile; ?>
                                        <?php if ($books_result->num_rows == 0): ?>
                                            <tr>
                                                <td colspan="4" class="text-center">No borrowed books found for this member.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

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
                                        <?php while ($payment = $payment_result->fetch_assoc()): ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($payment['pay_num']); ?></td>
                                                <td><?php echo htmlspecialchars($payment['ad_name']); ?></td>
                                                <td><?php echo htmlspecialchars($payment['fee']); ?></td>
                                                <td><?php echo htmlspecialchars($payment['date']); ?></td>
                                            </tr>
                                        <?php endwhile; ?>
                                        <?php if ($payment_result->num_rows == 0): ?>
                                            <tr>
                                                <td colspan="4" class="text-center">No payment found for this member.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

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

<?php include 'templates/footer.php'; ?>
<?php include 'templates/script.php'; ?>
</body>

</html>