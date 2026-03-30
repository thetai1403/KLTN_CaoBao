<?php
$conn = new mysqli("localhost", "root", "", "crawl_news");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "ALTER TABLE crawl_news ADD COLUMN content TEXT NULL";
if ($conn->query($sql) === TRUE) {
    echo "Column 'content' added successfully";
} else {
    echo "Error adding column: " . $conn->error;
}
$conn->close();
?>
