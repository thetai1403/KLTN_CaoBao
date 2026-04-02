<?php
$conn = new mysqli("localhost", "root", "", "crawl_news");
if ($conn->connect_error) {
    exit;
}
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id > 0) {
    $conn->query("UPDATE crawl_news SET view = view + 1 WHERE id = $id");
}
$conn->close();
