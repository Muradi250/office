<?php
// 📦 تنظیمات پروژه و فایل‌های مورد نیاز
require_once dirname(__DIR__, 3) . '/config/config.php';
require_once BASE_PATH . '/modules/User/UserController.php';

// 🎯 کنترلر و پردازش فرم
$controller = new UserController();
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = $controller->register($_POST);
}
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>ثبت‌نام</title>
    <link rel="stylesheet" href="<?= ASSETS_URL ?>css/style.css">
    <link rel="stylesheet" href="<?= ASSETS_URL ?>css/register.css">
</head>
<body>
    <div class="register-container">
        <h2>فرم ثبت‌نام</h2>

        <?php if (!empty($message)): ?>
            <div class="message"><?= $message; ?></div>
        <?php endif; ?>

        <form method="post" action="">
            <label for="name">نام کامل:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">ایمیل:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">رمز عبور:</label>
            <input type="password" id="password" name="password" required>

            <label for="confirm">تکرار رمز عبور:</label>
            <input type="password" id="confirm" name="confirm" required>

            <button type="submit">ثبت‌نام</button>
        </form>

        <p>قبلاً ثبت‌نام کردی؟ <a href="<?= BASE_URL ?>login.php">وارد شو</a></p>
    </div>
</body>
</html>
