<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('');
}
include "db.php";

// Check if 'cat_num' is passed via URL
$cat_num = isset($_GET['cat_num']) ? $_GET['cat_num'] : null;

// Fetch category ID based on 'cat_num'
if ($cat_num) {
    $category_sql = "SELECT cat_id FROM category WHERE cat_num = ?";
    $stmt = $conn->prepare($category_sql);
    $stmt->bind_param("s", $cat_num);
    $stmt->execute();
    $category_result = $stmt->get_result();

    if ($category_result->num_rows > 0) {
        $category_row = $category_result->fetch_assoc();
        $category_id = $category_row['cat_id'];
    } else {
        echo "<p>category not found.</p>";
        exit;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BookTrack | Explore Books</title>
    <link rel="icon" type="image/png" href="../../assets/img/BookTrack.png">

    <?php include 'templates/header.php'; ?>
    <style>
        /* HR LINE START */
        h2 {
            display: flex;
            flex-direction: row;
            padding-top: 20PX;
        }

        h2:before,
        h2:after {
            content: "";
            flex: 1 1;
            border-bottom: 2px solid #000;
            margin: auto;
        }


        .card {
            display: inline-block;
            position: relative;
            width: 100%;
            margin-bottom: 30px;
            border-radius: 6px;
            color: rgba(0, 0, 0, 0.87);
            background: #fff;
            box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 3px 1px -2px rgba(0, 0, 0, 0.2), 0 1px 5px 0 rgba(0, 0, 0, 0.12);
        }

        .card .card-image {
            height: 75% !important;
            position: relative;
            overflow: hidden;
            margin-left: 15px;
            margin-right: 15px;
            margin-top: -30px;
            border-radius: 6px;
            box-shadow: 0 16px 38px -12px rgba(0, 0, 0, 0.56), 0 4px 25px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.2);
        }

        .card .card-image img {
            width: 100%;
            height: 100%;
            border-radius: 6px;
            pointer-events: none;
        }

        .card .card-image .card-caption {
            position: absolute;
            bottom: 15px;
            left: 15px;
            color: #fff;
            font-size: 1.3em;
            text-shadow: 0 2px 5px rgba(33, 33, 33, 0.5);
        }

        .card img {
            width: 100%;
            height: auto;
        }

        .img-raised {
            box-shadow: 0 16px 38px -12px rgba(0, 0, 0, 0.56), 0 4px 25px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.2);
        }


        /* ============ Card Table ============ */

        .table {
            margin-bottom: 0px;
        }

        .card .table {
            padding: 15px 30px;
        }

        /* ============ Card Blog ============ */

        .card-blog {
            margin-top: 30px;
        }

        .card-blog .card-caption {
            margin-top: 5px;
        }

        .card-blog .card-image+.category {
            margin-top: 20px;
        }

        .card-raised {
            box-shadow: 0 16px 38px -12px rgba(0, 0, 0, 0.56), 0 4px 25px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.2);
        }

        .h6_cat_color {
            color: #a0a7ae;
            font-weight: bold;
        }
    </style>
</head>

<?php include 'templates/nav.php'; ?>
<?php include 'templates/sidebar.php'; ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Explore Books</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Explore Books</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body table-responsive p-0">
                        <div class="container-fluid">
                            <br>
                            <div class="row">
                                <div class="col sm-12">
                                    <br>
                                    <h2 class="page-heading gray-font flex-fill"><b>BOOKS</b></h2>
                                </div>
                            </div>
                            <br>
                            <article class="col-md-12">
                                <div class="cards-1">
                                    <div class="container">
                                        <div class="row">
                                            <?php
                                            // Fetch books by category or all books if no category specified
                                            $sql = "SELECT book_id,bk_num, title, image FROM books WHERE status = 'Active'";
                                            if ($cat_num) {
                                                $sql .= " AND cat_id = ?";
                                            }

                                            $stmt = $conn->prepare($sql);
                                            if ($cat_num) {
                                                $stmt->bind_param("i", $category_id);
                                            }
                                            $stmt->execute();
                                            $result = $stmt->get_result();

                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    $image_path = "../../" . $row['image'];
                                                    echo '
                                                    <div class="col-xl-3 col-sm-6">
                                                        <div class="card card-blog">
                                                            <div class="card-image">
                                                                <a href="#">
                                                                    <img class="img" src="' . $image_path . '" alt="' . $row['title'] . '">
                                                                </a>
                                                                <div class="ripple-cont"></div>
                                                            </div>
                                                            <div class="table">
                                                                <h6 class="text-center" style="height:35px"><b>' . $row['title'] . '</b></h6>
                                                                <h6 class="text-center h6_cat_color">' . $row['bk_num'] . '</h6>
                                                                <div class="text-center">
                                                                   <a href="explorebooks.php?book_id=' . $row['book_id'] . '">  <button type="button" class="btn btn-outline-secondary btn-sm" onclick="checkResult()">
                                                                        View Book Details
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>';
                                                }
                                            } else {
                                                echo "<p class='text-center'>No books available for this category.</p>";
                                            }

                                            $stmt->close();
                                            $conn->close();
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </div>
    <?php include 'templates/footer.php'; ?>
    <?php include 'templates/script.php'; ?>

</body>

</html>
