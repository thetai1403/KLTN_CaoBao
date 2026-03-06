<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Quản Trị - TestCrawl</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="templates/assets/css/dashboard.css">
</head>

<body>

    <aside class="sidebar">
        <div class="brand">
            <i class="fa-brands fa-slack"></i> TESTCRAWL
        </div>

        <nav class="menu">
            <div class="menu-label">Tổng quan</div>
            <a href="?module=admin&action=dashboard" class="nav-item active">
                <i class="fa-solid fa-chart-pie"></i> Dashboard
            </a>

            <div class="menu-label">Quản lý nội dung</div>
            <a href="?module=news&action=list" class="nav-item">
                <i class="fa-regular fa-newspaper"></i> Tin tức
            </a>
            <a href="?module=category&action=list" class="nav-item">
                <i class="fa-solid fa-list-ul"></i> Danh mục
            </a>

            <div class="menu-label">Hệ thống</div>
            <a href="?module=user&action=list" class="nav-item">
                <i class="fa-solid fa-users-gear"></i> Tài khoản
            </a>
            <a href="?module=setting&action=index" class="nav-item">
                <i class="fa-solid fa-sliders"></i> Cấu hình
            </a>
        </nav>
    </aside>

    <div class="main-wrapper">

        <header class="header">
            <div class="header-left">
                <i class="fa-solid fa-bars menu-toggle"></i>
                <div style="position: relative; color: var(--text-light);">
                    <i class="fa-solid fa-magnifying-glass"
                        style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); font-size: 14px;"></i>
                    <input type="text" placeholder="Tìm kiếm..."
                        style="padding: 8px 12px 8px 36px; border: 1px solid var(--border-color); border-radius: 8px; outline: none; font-size: 14px; width: 250px; background: #f9fafb;">
                </div>
            </div>

            <div class="header-right">
                <a href="http://localhost/testcrawl/BE/?module=news&action=list" target="_blank" class="btn-header"
                    title="Xem trang web">
                    <i class="fa-solid fa-house"></i> Trang chủ
                </a>

                <div class="user-dropdown">
                    <div class="user-toggle">
                        <div class="avatar"><?php echo strtoupper(substr($admin_name, 0, 1)); ?></div>
                        <div class="user-info">
                            <div class="user-name"><?php echo htmlspecialchars($admin_name); ?></div>
                            <div class="user-role">Administrator</div>
                        </div>
                        <i class="fa-solid fa-chevron-down" style="font-size: 12px; color: var(--text-light);"></i>
                    </div>

                    <ul class="dropdown-menu">
                        <li><a href="?module=admin&action=profile" class="dropdown-item"><i
                                    class="fa-regular fa-user"></i> Hồ sơ cá nhân</a></li>
                        <li><a href="?module=admin&action=settings" class="dropdown-item"><i
                                    class="fa-solid fa-gear"></i> Cài đặt</a></li>
                        <li><a href="?module=admin&action=logoutqtv" class="dropdown-item logoutqtv"><i
                                    class="fa-solid fa-right-from-bracket"></i> Đăng xuất</a></li>
                    </ul>
                </div>
            </div>
        </header>

        <main class="page-content">

            <div class="page-header">
                <h1 class="page-title">Quản lý tài khoản</h1>
                <button class="btn-primary">
                    <i class="fa-solid fa-plus"></i> Thêm tài khoản mới
                </button>
            </div>

            <div class="card">
                <table>
                    <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th width="30%">Thông tin tài khoản</th>
                            <th width="25%">Email</th>
                            <th width="15%">Vai trò</th>
                            <th width="15%">Trạng thái</th>
                            <th width="10%">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#01</td>
                            <td>
                                <div style="font-weight: 600; color: var(--text-main);">Phan Phúc</div>
                                <div style="font-size: 13px; color: var(--text-light);">Super Admin</div>
                            </td>
                            <td>phannphucc@gmail.com</td>
                            <td><span class="badge admin">Quản trị viên</span></td>
                            <td>
                                <span
                                    style="font-weight: 500; font-size: 13px; color: var(--text-main); display: flex; align-items: center;">
                                    <span class="status-dot status-active"></span> Hoạt động
                                </span>
                            </td>
                            <td>
                                <div class="action-btns">
                                    <a href="#" class="btn-icon edit" title="Chỉnh sửa"><i
                                            class="fa-solid fa-pen"></i></a>
                                    <a href="#" class="btn-icon delete" title="Xóa"><i
                                            class="fa-solid fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>#02</td>
                            <td>
                                <div style="font-weight: 600; color: var(--text-main);">Nguyễn Văn A</div>
                                <div style="font-size: 13px; color: var(--text-light);">Editor</div>
                            </td>
                            <td>user@example.com</td>
                            <td><span class="badge user">Người dùng</span></td>
                            <td>
                                <span
                                    style="font-weight: 500; font-size: 13px; color: var(--text-light); display: flex; align-items: center;">
                                    <span class="status-dot status-offline"></span> Offline
                                </span>
                            </td>
                            <td>
                                <div class="action-btns">
                                    <a href="#" class="btn-icon edit" title="Chỉnh sửa"><i
                                            class="fa-solid fa-pen"></i></a>
                                    <a href="#" class="btn-icon delete" title="Xóa"><i
                                            class="fa-solid fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div
                    style="padding: 16px 24px; border-top: 1px solid var(--border-color); color: var(--text-light); font-size: 14px; display: flex; justify-content: space-between; align-items: center;">
                    <div>Hiển thị 1 đến 2 trong tổng số 2 mục</div>
                    <div style="display: flex; gap: 5px;">
                        <button
                            style="padding: 6px 12px; border: 1px solid var(--border-color); background: #fff; border-radius: 6px; cursor: not-allowed; color: #d1d5db;">Trước</button>
                        <button
                            style="padding: 6px 12px; border: 1px solid var(--primary); background: var(--primary); color: #fff; border-radius: 6px;">1</button>
                        <button
                            style="padding: 6px 12px; border: 1px solid var(--border-color); background: #fff; border-radius: 6px; cursor: pointer;">Tiếp</button>
                    </div>
                </div>
            </div>

        </main>
    </div>

</body>

</html>
