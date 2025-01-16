<?php
session_start();
if (!isset($_SESSION['lt_bk_id'])) {
  header('');
}
include'../db.php';


$lt_bk_id =  $_GET['lt_bk_id'];

$sql = "DELETE FROM `latest_book` WHERE lt_bk_id = $lt_bk_id";
$resp = $conn->query($sql);


$sql="UPDATE `latest_book` SET `status`='Y' WHERE lt_bk_id=$lt_bk_id;";
//$conn->query($sql);


if($resp)
header("Location:http://localhost/BookTrack/pages/admin/viewlatestbook.php?msg=Success");
else
header("Location:http://localhost/BookTrack/pages/admin/viewlatestbook.php?msg=Error");

?>