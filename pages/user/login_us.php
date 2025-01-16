<?php
session_start();

// Redirect if already logged in
if (isset($_SESSION['mbr_id'])) {
    header('Location: dashboard.php');
    exit();
}

include 'db.php';

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']); // For production, use password_hash() and password_verify()

    // Query to validate user credentials
    $sql = "SELECT * FROM `member_login` WHERE `email` = ? AND `password` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Set session variables
        $_SESSION['mbr_id'] = $row['member_id'];
        $_SESSION['mbr_number'] = $row['mbr_number'];
        $_SESSION['mbr_name'] = $row['mbr_name'];

        // Redirect to view user details
        header('Location: dashboard.php');
        exit();
    } else {
        echo "<script>alert('Incorrect email or password. Please try again.');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../bootstrap/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" href="../../assets/css/login.css">
    <title>BookTrack | User Login</title>
    <link rel="icon" type="image/png" href="../../assets/img/BookTrack.png">
</head>

<body>

    <div class="wrapper">
        <div class="logo">
            <img src="../../assets/img/Book Track.png" alt="">
        </div>
        <div class="text-center mt-4 name">
            Sign In
        </div>
        <form action="" method="POST" class="p-3 mt-3">
            <div class="form-field d-flex align-items-center">
                <span class="far fa-user"></span>
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="fas fa-key"></span>
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <button type="submit" name="submit" class="btn mt-3">Sign In</button>
        </form>
        <div class="text-center fs-6">
            <p>Don't have an account?<a href="register_us.php"> &nbsp; Sign Up</a></p>
        </div>
    </div>

    <script src="../../assets/js/jquery-3.6.1.min.js"></script>
    <script src="../../bootstrap/assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>