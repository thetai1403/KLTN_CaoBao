<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 1. KIỂM TRA QUYỀN ADMIN
if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: ?module=admin&action=loginqtv");
    exit;
}

require_once __DIR__ . '/../../includes/session.php';
global $conn;
if (!isset($conn)) $conn = new mysqli("localhost", "root", "", "crawl_news");

$sql = "SELECT n.*, c.name as category_name FROM crawl_news n LEFT JOIN category c ON n.category_id = c.id ORDER BY n.id DESC LIMIT 50";
$news = [];

try {
    if (function_exists('getAll')) {
        $news = getAll($sql);
    }
    
    if (empty($news)) {
        $result = $conn->query($sql);
        if($result) {
            while($row = $result->fetch_assoc()) {
                $news[] = $row;
            }
        }
    }
} catch(Exception $e) {
    try {
        $sql2 = "SELECT * FROM crawl_news ORDER BY id DESC LIMIT 50";
        if (function_exists('getAll')) {
            $news = getAll($sql2);
        }
        if (empty($news)) {
            $result2 = $conn->query($sql2);
            if($result2) {
                while($row = $result2->fetch_assoc()) {
                    $news[] = $row;
                }
            }
        }
    } catch (Exception $e2) {
        $news = [];
    }
}

// XÓA NEWS 
if(isset($_GET['delete_id'])) {
    $del_id = (int)$_GET['delete_id'];
    $conn->query("DELETE FROM news WHERE id = $del_id");
    header("Location: ?module=admin&action=news");
    exit;
}

renderView('admin/news', [
    'news' => $news
]);
