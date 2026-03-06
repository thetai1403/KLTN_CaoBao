<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đăng nhập Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="templates/assets/css/loginqtv.css">
    <style>

    </style>
</head>

<body>
    <div class="admin-card">
        <h2>Đăng nhập quản trị</h2>

        <?php if($error_msg): ?>
        <div class="error">
            <i class="fa-solid fa-triangle-exclamation"></i> <?php echo $error_msg; ?>
        </div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required placeholder="admin@example.com">
            </div>

            <div class="form-group">
                <label>Mật khẩu</label>
                <input type="password" name="password" required placeholder="••••••••">
            </div>

            <button type="submit">Đăng nhập</button>
        </form>
    </div>
</body>

</html>
