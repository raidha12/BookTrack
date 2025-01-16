<?php
include 'db.php';

// SQL query to get the count of admin
$sql = "SELECT COUNT(ad_id) AS admin_count FROM `admin`";

$result = $conn->query($sql);

if ($result) {
    $row = $result->fetch_assoc();

    echo $row['admin_count'];
} else {
    echo "Error: " . $conn->error;
}

// Close the connection
$conn->close();
