<?php
define('_TAI', true);
require __DIR__ . '/../../includes/database.php';
require __DIR__ . '/../../includes/functions.php';

session_start();

$user_id = $_SESSION['user_id'] ?? 1;

$perPage = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $perPage;
$keyword  = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
$category = isset($_GET['category']) ? trim($_GET['category']) : '';
$where = " WHERE 1=1 ";

if (!empty($keyword)) {
    $keyword = addslashes($keyword);
    $where .= " AND title LIKE '%$keyword%' ";
}

if (!empty($category)) {
    $category = addslashes($category);
    $where .= " AND category = '$category' ";
}

$sql = "SELECT n.*,
       EXISTS (
           SELECT 1 
           FROM favourite_news f 
           WHERE f.news_id = n.id AND f.user_id = $user_id
       ) AS is_favourite
FROM crawl_news n
$where
ORDER BY pubDate DESC
LIMIT $perPage OFFSET $offset";

$listNews = getAll($sql);

foreach ($listNews as &$item) {
    $item['is_favourite'] = (bool)$item['is_favourite'];
}
unset($item);
header('Content-Type: application/json');
echo json_encode($listNews, JSON_UNESCAPED_UNICODE);