<?php
include 'db.php';

error_reporting(0);
session_start();

if (isset($_SESSION['ad_name'])) {
  header("Location: register_ad.php");
}

if (isset($_POST['submit'])) {
  $ad_name = $_POST['ad_name'];
  $email = $_POST['email'];
  $password = md5($_POST['password']);
  $cpassword = md5($_POST['cpassword']);

  if ($password == $cpassword) {
    $sql = "SELECT * FROM `admin` WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if (!$result->num_rows > 0) {
      $sql = "INSERT INTO `admin` (ad_name, email, password)
					VALUES ('$ad_name', '$email', '$password')";
      $result = mysqli_query($conn, $sql);

      if ($result) {
        echo "<script>alert('Wow! Admin Registration Completed.')</script>";
        $ad_name = "";
        $email = "";
        $_POST['password'] = "";
        $_POST['cpassword'] = "";
        header("Location: login_ad.php");
      } else {
        echo "<script>alert('Woops! Something Wrong Went.')</script>";
      }
    } else {
      echo "<script>alert('Woops! Email Already Exists.')</script>";
    }
  } else {
    echo "<script>alert('Passwords do not match. Please enter matching passwords.')</script>";
  }
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
  <title>BookTrack | Admin Login</title>
  <link rel="icon" type="image/png" href="../../assets/img/BookTrack.png">
</head>

<body>

  <div class="wrapper">
    <div class="logo">
      <img src="../../assets/img/Book Track.png" alt="">
    </div>
    <div class="text-center mt-4 name">
      Sign Up
    </div>
    <form action="" method="POST" class="p-3 mt-3">
      <div class="form-field d-flex align-items-center">
        <span class="fas fa-user"></span>
        <input type="text" name="ad_name" placeholder="Admin Name" value="<?php echo $ad_name; ?>" required>
      </div>
      <div class="form-field d-flex align-items-center">
        <span class="fas fa-envelope"></span>
        <input type="email" name="email" placeholder="Email" value="<?php echo $email; ?>" required>
      </div>
      <div class="form-field d-flex align-items-center">
        <span class="fas fa-key"></span>
        <input type="password" name="password" placeholder="Create Password" value="<?php echo $_POST['password']; ?>" required>
      </div>
      <div class="form-field d-flex align-items-center">
        <span class="fas fa-key"></span>
        <input type="password" name="cpassword" placeholder="Confirm Password" value="<?php echo $_POST['cpassword']; ?>" required>
      </div>
      <button type="submit" name="submit" class="btn mt-3">Create Account</button>
    </form>
    <div class="text-center fs-6">
      <a href="login_ad.php">Sign In</a>
    </div>
  </div>

  <script src="../../assets/js/jquery-3.6.1.min.js"></script>
  <script src="../../assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>