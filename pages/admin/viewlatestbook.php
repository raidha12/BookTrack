<?php
session_start();
if (!isset($_SESSION['ad_id'])) {
    header('');
}
include "db.php";

// Fetch latest books
$latestBooks = '';

$sql = "SELECT latest_book.lt_bk_id, latest_book.title, author.au_name, category.cat_name, latest_book.pages, latest_book.image, latest_book.status
        FROM latest_book
        LEFT JOIN category ON latest_book.cat_id = category.cat_id
        LEFT JOIN author ON latest_book.au_id = author.au_id;";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $imagePath = "../../" . $row['image'];
        $latestBooks .= '<tr>
            <td>' . $row['lt_bk_id'] . '</td>
            <td>' . $row['title'] . '</td>
            <td>' . $row['au_name'] . '</td>
            <td>' . $row['cat_name'] . '</td>
            <td>' . $row['pages'] . '</td>
            <td><img src="' . $imagePath . '" alt="Book Image" width="75" height="100"></td>
            <td>' . $row['status'] . '</td>
            <td>
                <a href="view_explorelatestbook.php?lt_bk_id=' . $row['lt_bk_id'] . '"><img src="../../assets/img/view.png" alt="View"></a>
                <a href="action/deletelatestbook.php?lt_bk_id=' . $row['lt_bk_id'] . '"><img src="../../assets/img/delete.png" alt="Delete"></a>
            </td>
        </tr>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BookTrack | Latest Books</title>
    <link rel="icon" type="image/png" href="../../assets/img/BookTrack.png">

    <!-- Header -->
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
                        <h1>Latest Books</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active">Latest Books</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Book ID</th>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Category</th>
                                        <th>Pages</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php echo $latestBooks; ?>
                                </tbody>
                            </table>
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
