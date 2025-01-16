<?php
include 'db.php';

// SQL query to get the count of books
$sql = "SELECT COUNT(book_id) AS book_count FROM books";

$result = $conn->query($sql);

if ($result) {
    $row = $result->fetch_assoc();

    echo $row['book_count'];
} else {
    echo "Error: " . $conn->error;
}

// Close the connection
$conn->close();
