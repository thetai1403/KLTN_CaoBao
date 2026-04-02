<?php
$conn = new mysqli("localhost", "root", "", "crawl_news");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Add view column if it doesn't exist
$check_sql = "SHOW COLUMNS FROM `crawl_news` LIKE 'view'";
$check_res = $conn->query($check_sql);
if ($check_res->num_rows == 0) {
    // Column does not exist, so add it
    $sql = "ALTER TABLE `crawl_news` ADD COLUMN `view` INT DEFAULT 0";
    if ($conn->query($sql) === TRUE) {
        echo "Column 'view' added successfully";
    } else {
        echo "Error adding column: " . $conn->error;
    }
} else {
    echo "Column 'view' already exists";
}
$conn->close();
?>
