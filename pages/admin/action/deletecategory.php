<?php

session_start();
if (!isset($_SESSION['cat_id'])) {
  header('');
}
include '../db.php';


$cat_id =  $_GET['cat_id'];

$sql = "DELETE FROM `category` WHERE cat_id = $cat_id";
$resp = $conn->query($sql);


$sql="UPDATE `category` SET `status`='Y' WHERE cat_id=$cat_id;";
//$conn->query($sql);


if($resp)
header("Location:http://localhost/BookTrack/pages/admin/viewcategory.php?msg=Success");
else
header("Location:http://localhost/BookTrack/pages/admin/viewcategory.php?msg=Error");

?>
