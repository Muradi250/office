<?php
require_once BASE_PATH . '/modules/User/UserController.php';

$controller = new UserController();
$message = '';
// چون با AJAX کار میکنیم، اینجا پردازش معمولی نمی‌ذاریم
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>ورود</title>
    <link rel="stylesheet" href="<?= ASSETS_URL ?>css/style.css">
    <link rel="stylesheet" href="<?= ASSETS_URL ?>css/login.css">
</head>
<body>
    <div class="ariashimi"></div>

    <div class="login-container">
        <h1>آریاشیمی</h1>
        <h2>فرم ورود</h2>

        <!-- پیام‌ها اینجا نمایش داده میشن -->
        <div id="message" style="color: red; margin-bottom: 15px;"></div>

        <form id="loginForm" method="post" action="javascript:void(0);">
            <label for="email">ایمیل:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">رمز عبور:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">ورود</button>
        </form>

        <p>حساب نداری؟ <a href="<?= BASE_URL ?>register.php">ثبت‌نام کن</a></p>
    </div>

    <script src="/login-system/public/assets/js/main.js"></script>

</body>
</html>
