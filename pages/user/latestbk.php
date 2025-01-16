<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('');
}
include "db.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BookTrack | Latest Books</title>
    <link rel="icon" type="image/png" href="../../assets/img/BookTrack.png">

      <!-- header -->
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

        /* HR LINE end */
        /*---------------------------------------------------------------------- /
NARROW CARDS
----------------------------------------------------------------------- */

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

        .card-blog .card-image+.latest_book {
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
                    <h1>Explore Books</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Explore Books</li>

                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>



    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-12">
                <div class="card">

                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">

                        <!-- carousel cards -->
                        <!-- handbag start -->
                        <div class="container-fluid">
                            <br>
                            <div class="row">
                                <div class="col sm-12">
                                    <br>
                                    <h2 class="page-heading gray-font flex-fill"><b>LATEST BOOKS</b></h2>
                                </div>
                            </div>
                            <br>
                            <article class="col-md-12">
                                <div class="cards-1">
                                    <div class="container">
                                        <div class="row">
                                            <?php
                                            // Fetch categories from the database
                                            $sql = "SELECT lt_bk_id,lst_num, title, image FROM latest_book WHERE status = 'Active'";
                                            $result = $conn->query($sql);

                                            if ($result->num_rows > 0) {
                                                // Output data for each latest_book
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
                                                                <h6 class="text-center" style="height:30px"><b>' . $row['title'] . '</b></h6>
                                                                <h6 class="text-center h6_cat_color">' . $row['lst_num'] . '</h6>
                                                                <div class="text-center">
                                                                   <a href="explorelatestbk.php?lt_bk_id=' . $row['lt_bk_id'] . '">  <button type="button" class="btn btn-outline-secondary btn-sm" onclick="checkResult()">
                                                                        View Book Details
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>';
                                                }
                                            } else {
                                                echo "<p>No categories available</p>";
                                            }

                                            // Close the database connection
                                            $conn->close();
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <br>
                        </div>
                        <!-- handbag end -->

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


<!-- Footer -->
<?php include 'templates/footer.php'; ?>

<!-- Script -->
<?php include 'templates/script.php'; ?>

</body>
</html>