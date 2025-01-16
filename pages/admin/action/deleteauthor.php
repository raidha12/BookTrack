<?php

session_start();
if (!isset($_SESSION['au_id'])) {
  header('');
}
include '../db.php';


$au_id =  $_GET['au_id'];

$sql = "DELETE FROM `author` WHERE au_id = $au_id";
$resp = $conn->query($sql);


$sql="UPDATE `author` SET `status`='A' WHERE au_id=$au_id;";
//$conn->query($sql);


if($resp)
header("Location:http://localhost/BookTrack/pages/admin/viewauthor.php?msg=Success");
else
header("Location:http://localhost/BookTrack/pages/admin/viewauthor.php?msg=Error");

?>


