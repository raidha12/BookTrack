<?php
session_start();
if (!isset($_SESSION['mbr_name'])) {
  header('');
}
include "db.php";

if (isset($_POST['submit'])) {

  // Retrieve and sanitize form data
  $mbr_number = $_POST['mbr_number'];  // Fixed this
  $mbr_name = $_POST['mbr_name'];
  $email = $_POST['email'];
  $password = md5($_POST['password']);
  $cpassword = md5($_POST['cpassword']);
  $date = date('Y-m-d');

  // Validate passwords
  if ($password === $cpassword) {
    // Check if the email already exists
    $check_email = "SELECT * FROM member_login WHERE email = '$email'";
    $result = $conn->query($check_email);

    if ($result->num_rows > 0) {
      echo "<script>alert('Email already exists. Please use a different email.');</script>";
    } else {
      // Insert user into the database
      // Fixed the typo from mbr_numberber to mbr_number
      $sql = "INSERT INTO member_login(mbr_number,mbr_name, email, `password`,`reg_date`) 
              VALUES ('$mbr_number','$mbr_name','$email','$password','$date')";
      if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Registration successful');
                window.location.href = 'login_us.php'; // Redirect after success
              </script>";
      } else {
        echo "<script>alert('Something went wrong. Please try again.');</script>";
      }
    }
  } else {
    echo "<script>alert('Passwords do not match. Please try again.');</script>";
  }
}

$conn->close();
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
  <title>BookTrack | User Sign Up</title>
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
        <span class="fas fa-id-card"></span>
        <input type="text" name="mbr_number" placeholder="Member Number" required>
      </div>
      <div class="form-field d-flex align-items-center">
        <span class="far fa-user"></span>
        <input type="text" name="mbr_name" placeholder="Username" required>
      </div>
      <div class="form-field d-flex align-items-center">
        <span class="fas fa-envelope"></span>
        <input type="email" name="email" placeholder="Email" required>
      </div>
      <div class="form-field d-flex align-items-center">
        <span class="fas fa-key"></span>
        <input type="password" name="password" placeholder="Create Password" required>
      </div>
      <div class="form-field d-flex align-items-center">
        <span class="fas fa-key"></span>
        <input type="password" name="cpassword" placeholder="Confirm Password" required>
      </div>
      <button type="submit" name="submit" class="btn mt-3">Create Account</button>
    </form>
    <div class="text-center fs-6">
      <p>Have an account?<a href="login_us.php"> &nbsp; Sign In</a></p>
    </div>
  </div>

  <script src="../../assets/js/jquery-3.6.1.min.js"></script>
  <script src="../../bootstrap/assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>