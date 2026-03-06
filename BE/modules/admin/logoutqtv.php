<?php
session_start();

// 1. Xóa tất cả các biến session đang lưu (id, name, role...)
session_unset();

// 2. Hủy hoàn toàn phiên làm việc
session_destroy();

// 3. Chuyển hướng về trang Đăng nhập Quản trị
header("Location: ?module=admin&action=loginqtv");
exit;
?>