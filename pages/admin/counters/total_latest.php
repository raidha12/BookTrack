<?php
include 'db.php';

// SQL query to get the count of latest books
$sql = "SELECT COUNT(lt_bk_id) AS latest_count FROM latest_book";

$result = $conn->query($sql);

if ($result) {
    $row = $result->fetch_assoc();

    echo $row['latest_count'];
} else {
    echo "Error: " . $conn->error;
}

// Close the connection
$conn->close();
