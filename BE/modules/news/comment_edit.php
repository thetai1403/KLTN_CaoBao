<?php
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../../includes/database.php';
require_once __DIR__ . '/../../includes/session.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Thiết lập header để trả về JSON cho JavaScript
header('Content-Type: application/json');

// Chuẩn bị mảng response
$response = ['success' => false, 'message' => 'Lỗi không xác định.'];

// 1. Kiểm tra đăng nhập
if (empty($_SESSION['user_id'])) {
    $response['message'] = 'Bạn cần đăng nhập để thực hiện hành động này.';
    echo json_encode($response);
    exit;
}

// 2. Kiểm tra phương thức POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $response['message'] = 'Yêu cầu không hợp lệ.';
    echo json_encode($response);
    exit;
}

// 3. Lấy dữ liệu
$comment_id = isset($_POST['comment_id']) ? (int) $_POST['comment_id'] : 0;
$content = trim($_POST['content'] ?? '');

if ($comment_id <= 0) {
    $response['message'] = 'Bình luận không hợp lệ.';
    echo json_encode($response);
    exit;
}

if ($content === '') {
    $response['message'] = 'Nội dung bình luận không được để trống.';
    echo json_encode($response);
    exit;
}

// 4. Kiểm tra quyền sở hữu (Giống hệt file delete)
$stmt = $conn->prepare("SELECT user_id FROM comments WHERE id = ?");
$stmt->bind_param("i", $comment_id);
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();
$stmt->close();

if ($result) {
    $commentOwner = $result['user_id'];
    $currentUser  = (int)$_SESSION['user_id'];
    $isAdmin      = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';

    // 5. Nếu có quyền -> Thực thi CẬP NHẬT
    if ($commentOwner == $currentUser || $isAdmin) {
        
        // (Khuyên dùng) Thêm cột 'updated_at' vào bảng 'comments'
        // $stmt = $conn->prepare("UPDATE comments SET content = ?, updated_at = NOW() WHERE id = ?");
        
        // Nếu không có cột 'updated_at', ta chỉ cập nhật nội dung:
        $stmt = $conn->prepare("UPDATE comments SET content = ? WHERE id = ?");
        $stmt->bind_param("si", $content, $comment_id);
        
        if ($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = 'Cập nhật thành công!';
            // Trả về nội dung đã làm sạch để JS hiển thị
            $response['content'] = htmlspecialchars($content);
        } else {
            $response['message'] = 'Lỗi khi cập nhật cơ sở dữ liệu.';
        }
        $stmt->close();
    } else {
        $response['message'] = 'Bạn không có quyền sửa bình luận này.';
    }
} else {
    $response['message'] = 'Không tìm thấy bình luận.';
}

// 6. Trả về kết quả JSON
echo json_encode($response);
exit;
?>