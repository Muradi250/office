<?php
session_start();

// اگر کاربر وارد نشده بود، هدایت به صفحه ورود
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>خوشامدگویی</title>
    <style>
        body {
            font-family: Tahoma, sans-serif;
            background: #f0f8ff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .welcome-box {
            text-align: center;
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            max-width: 400px;
        }
        .welcome-box h1 {
            color: #2e8b57;
            margin-bottom: 20px;
        }
        .welcome-box p {
            font-size: 1.1em;
            margin-bottom: 30px;
        }
        .welcome-box button {
            background: #2e8b57;
            border: none;
            color: white;
            padding: 12px 30px;
            font-size: 1em;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .welcome-box button:hover {
            background: #276746;
        }
    </style>
    <script>
        // هدایت خودکار بعد از 5 ثانیه به داشبورد
        setTimeout(() => {
            window.location.href = 'dashboard.php';
        }, 5000);
    </script>
</head>
<body>
    <div class="welcome-box">
        <h1>خوش آمدید!</h1>
        <p>شما با موفقیت وارد شدید. می‌توانید به داشبورد خود بروید.</p>
        <button onclick="window.location.href='dashboard.php'">رفتن به داشبورد</button>
    </div>
</body>
</html>
