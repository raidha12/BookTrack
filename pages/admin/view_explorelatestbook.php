<?php
session_start();
if (!isset($_SESSION['ad_id'])) {
  header('');
}
include "db.php";

// Get the lt_bk_id from the URL
$lt_bk_id = isset($_GET['lt_bk_id']) ? intval($_GET['lt_bk_id']) : 0;

// Fetch book details from the database, including author name and category name
$query = "
    SELECT 
        latest_book.*, 
        author.au_name AS author_name, 
        category.cat_name AS category_name 
    FROM 
        latest_book 
    LEFT JOIN 
        author ON latest_book.au_id = author.au_id 
    LEFT JOIN 
        category ON latest_book.cat_id = category.cat_id 
    WHERE 
        latest_book.lt_bk_id = $lt_bk_id
";
$result = mysqli_query($conn, $query);
$book = mysqli_fetch_assoc($result);

if (!$book) {
    echo "<h1>Book not found!</h1>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BookTrack | Latest Book</title>
    <link rel="icon" type="image/png" href="../../assets/img/BookTrack.png">

    <!-- header -->
    <?php include 'templates/header.php'; ?>
    <!-- page css -->
    <link rel="stylesheet" href="../../assets/css/viewbooks.css">
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
                        <h1>Latest Book</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active">Latest Book</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <!-- Image card and button -->
                        <div class="col-md-3">
                            <div class="card book-card">
                                <?php
                                // Set the image path
                                $imagePath = "../../" . htmlspecialchars($book['image']);
                                ?>
                                <img src="<?php echo $imagePath; ?>" alt="Book Image">
                            </div>
                        </div>

                        <!-- Book info organized in list format -->
                        <div class="col-md-9">
                            <div class="book-info">
                                <p><b><span>Book Number:&nbsp;</span></b> <?php echo htmlspecialchars($book['lst_num']); ?></p>
                                <p><b><span>Title:&nbsp;</span></b> <?php echo htmlspecialchars($book['title']); ?></p>
                                <p><b><span>Author:&nbsp;</span></b> <?php echo htmlspecialchars($book['author_name']); ?></p>
                                <p><b><span>Category:&nbsp;</span></b> <?php echo htmlspecialchars($book['category_name']); ?></p>
                                <p><b><span>Publisher:&nbsp;</span></b> <?php echo htmlspecialchars($book['publisher']); ?></p>
                                <p><b><span>ISBN Number:&nbsp;</span></b> <?php echo htmlspecialchars($book['isbn']); ?></p>
                                <p><b><span>Pages:&nbsp;</span></b> <?php echo htmlspecialchars($book['pages']); ?></p>
                                <p><b><span>Status:&nbsp;</span></b> <?php echo htmlspecialchars($book['status']); ?></p>
                                <p><b><span>Description:&nbsp;</span></b> <?php echo htmlspecialchars($book['description']); ?></p>
                                <p><b><span>PDF File:&nbsp;</span></b> 
                                    <?php
                                    // Set the PDF path
                                    $pdfPath = "../../" . htmlspecialchars($book['pdf']); 
                                    if (!empty($book['pdf'])): ?>
                                        <a href="<?php echo $pdfPath; ?>" target="_blank" class="btn btn-primary">View PDF</a>
                                    <?php else: ?>
                                        No PDF available
                                    <?php endif; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- /.content-wrapper -->

    <!-- Footer -->
    <?php include 'templates/footer.php'; ?>

    <!-- Scripts -->
    <?php include 'templates/script.php'; ?>
</body>

</html>
