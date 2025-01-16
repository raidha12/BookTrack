<?php
include 'db.php';

// SQL query to get the count of authors
$sql = "SELECT COUNT(au_id) AS author_count FROM author";

$result = $conn->query($sql);

if ($result) {
    $row = $result->fetch_assoc();

    echo $row['author_count'];
} else {
    echo "Error: " . $conn->error;
}

// Close the connection
$conn->close();
