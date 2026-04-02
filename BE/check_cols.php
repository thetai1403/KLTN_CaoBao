<?php
$conn = new mysqli('localhost', 'root', '', 'crawl_news');
$res = $conn->query('SHOW COLUMNS FROM crawl_news');
while($row = $res->fetch_assoc()) {
    print_r($row);
}
