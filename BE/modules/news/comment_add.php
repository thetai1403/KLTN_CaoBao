<?php
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../../includes/database.php';
require_once __DIR__ . '/../../includes/session.php';
require_once __DIR__ . '/../../includes/functions.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['user_id'])) {
    header('Location: /login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = (int)$_SESSION['user_id'];
    $news_id = (int)($_POST['news_id'] ?? 0);
    $content = trim($_POST['content'] ?? '');

    if ($news_id > 0 && $content !== '') {
        $stmt = $conn->prepare("INSERT INTO comments (user_id, news_id, content, created_at) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("iis", $user_id, $news_id, $content);
        $stmt->execute();
        $stmt->close();
    }
    header("Location: /testcrawl/BE/index.php?module=news&action=comment&id=" . $news_id);
exit;

}

header("Location: /");
exit;