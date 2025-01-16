<?php
include 'db.php';

// SQL query to get the count of category
$sql = "SELECT COUNT(cat_id) AS category_count FROM category";

$result = $conn->query($sql);

if ($result) {
    $row = $result->fetch_assoc();

    echo $row['category_count'];
} else {
    echo "Error: " . $conn->error;
}

// Close the connection
$conn->close();
