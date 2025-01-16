<?php
include 'db.php';

// SQL query to get the count of students
$sql = "SELECT COUNT(mbr_id) AS student_count FROM member";

$result = $conn->query($sql);

if ($result) {
    $row = $result->fetch_assoc();

    echo $row['student_count'];
} else {
    echo "Error: " . $conn->error;
}

// Close the connection
$conn->close();
