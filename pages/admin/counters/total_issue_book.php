<?php
include 'db.php';

// SQL query to get the count of issued books
$sql = "SELECT COUNT(is_bk_id) AS issue_book_count FROM issue_book";

$result = $conn->query($sql);

if ($result) {
    $row = $result->fetch_assoc();

    echo $row['issue_book_count'];
} else {
    echo "Error: " . $conn->error;
}

// Close the connection
$conn->close();
