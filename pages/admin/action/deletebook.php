<?php
session_start();
if (!isset($_SESSION['book_id'])) {
  header('');
}
include'../db.php';


$book_id =  $_GET['book_id'];

$sql = "DELETE FROM `books` WHERE book_id = $book_id";
$resp = $conn->query($sql);


$sql="UPDATE `books` SET `status`='Y' WHERE book_id=$book_id;";
//$conn->query($sql);


if($resp)
header("Location:http://localhost/BookTrack/pages/admin/viewbook.php?msg=Success");
else
header("Location:http://localhost/BookTrack/pages/admin/viewbook.php?msg=Error");

?>