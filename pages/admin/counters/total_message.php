<?php
include 'db.php';

// SQL query to get the count of message
$sql = "SELECT COUNT(msg_id) AS message_count FROM `message`";

$result = $conn->query($sql);

if ($result) {
    $row = $result->fetch_assoc();

    echo $row['message_count'];
} else {
    echo "Error: " . $conn->error;
}

// Close the connection
$conn->close();
