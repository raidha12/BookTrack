<?php
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['mbr_name'])) {
    header('Location: login.php');
    exit();
}

include "db.php";

// Get the book_id from the URL
$book_id = isset($_GET['book_id']) ? intval($_GET['book_id']) : 0;

// Fetch book details from the database with author and category names
$query = "
    SELECT 
        books.*, 
        author.au_name AS author_name, 
        category.cat_name AS category_name 
    FROM 
        books
    LEFT JOIN 
        author ON books.au_id = author.au_id
    LEFT JOIN 
        category ON books.cat_id = category.cat_id
    WHERE 
        books.book_id = $book_id
";
$result = mysqli_query($conn, $query);
$book = mysqli_fetch_assoc($result);

if (!$book) {
    echo "<h1>Book not found!</h1>";
    exit();
}

// Handle the reserve button click
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reserve'])) {
    // Get member details from the session
    $mbr_name = mysqli_real_escape_string($conn, $_SESSION['mbr_name']);
    $mbr_num = mysqli_real_escape_string($conn, $_SESSION['mbr_number']); // Assuming 'mbr_number' is stored in session
    $book_title = mysqli_real_escape_string($conn, $book['title']);
    $book_image = mysqli_real_escape_string($conn, $book['image']); // Image for the reserved book
    $date = date('Y-m-d'); // Get current date
 
    // Insert reservation details into reserve_book table
    $reserve_query = "
        INSERT INTO reserve_book (mbr_num, mbr_name, title, image,date)
        VALUES ('$mbr_num', '$mbr_name', '$book_title', '$book_image','$date')
    ";
    if (mysqli_query($conn, $reserve_query)) {
        echo "<script>alert('Book reserved successfully!');</script>";
    } else {
        echo "<script>alert('Error reserving book. Please try again.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BookTrack | View Book</title>
    <link rel="icon" type="image/png" href="../../assets/img/BookTrack.png">

    <!-- header -->
    <?php include 'templates/header.php'; ?>
    <!-- page css -->
    <link rel="stylesheet" href="../../assets/css/viewbooks.css">
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
                        <h1>View Book</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active">View Book</li>
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
                        <!-- Image card and reserve button -->
                        <div class="col-md-3">
                            <form method="post" action="explorebooks.php?book_id=<?php echo $book_id; ?>">
                                <div class="card book-card">
                                    <?php
                                    // Set the image path
                                    $imagePath = "../../" . htmlspecialchars($book['image']);
                                    ?>
                                    <img src="<?php echo $imagePath; ?>" alt="Book Image">
                                    <button type="submit" name="reserve" class="btn btn-primary mt-3">Reserve Book</button>
                                </div>
                            </form>
                        </div>

                        <!-- Book info -->
                        <div class="col-md-9">
                            <div class="book-info">
                                <p><b><span>Book Number:&nbsp;</span></b> <?php echo htmlspecialchars($book['bk_num']); ?></p>
                                <p><b><span>Title:&nbsp;</span></b> <?php echo htmlspecialchars($book['title']); ?></p>
                                <p><b><span>Author:&nbsp;</span></b> <?php echo htmlspecialchars($book['author_name']); ?></p>
                                <p><b><span>Category:&nbsp;</span></b> <?php echo htmlspecialchars($book['category_name']); ?></p>
                                <p><b><span>Publisher:&nbsp;</span></b> <?php echo htmlspecialchars($book['publisher']); ?></p>
                                <p><b><span>ISBN Number:&nbsp;</span></b> <?php echo htmlspecialchars($book['isbn']); ?></p>
                                <p><b><span>Pages:&nbsp;</span></b> <?php echo htmlspecialchars($book['pages']); ?></p>
                                <p><b><span>Status:&nbsp;</span></b> <?php echo htmlspecialchars($book['status']); ?></p>
                                <p><b><span>Description:&nbsp;</span></b> <?php echo htmlspecialchars($book['description']); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Footer -->
        
    </div>
    <?php include 'templates/footer.php'; ?>
    <!-- Script -->
    <?php include 'templates/script.php'; ?>
</body>

</html>
