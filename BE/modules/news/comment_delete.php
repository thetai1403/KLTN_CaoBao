<?php
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../../includes/database.php';
require_once __DIR__ . '/../../includes/session.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['user_id'])) {
    header('Location: /login.php');
    exit;
}

$comment_id = isset($_POST['comment_id']) ? (int) $_POST['comment_id'] : 0;
$news_id    = isset($_POST['news_id']) ? (int) $_POST['news_id'] : 0;
$stmt = $conn->prepare("SELECT user_id FROM comments WHERE id = ?");
$stmt->bind_param("i", $comment_id);
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();
$stmt->close();

if ($result) {
    $commentOwner = $result['user_id'];
    $currentUser  = $_SESSION['user_id'];
    $isAdmin      = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';

    if ($commentOwner == $currentUser || $isAdmin) {
        $stmt = $conn->prepare("DELETE FROM comments WHERE id = ?");
        $stmt->bind_param("i", $comment_id);
        $stmt->execute();
        $stmt->close();
    }
}

header("Location: /testcrawl/BE/index.php?module=news&action=comment&id=" . $news_id);
exit;