<?php
// public/profile.php

require_once '../config/config.php';
require_once '../core/Session.php';
require_once '../core/Helpers.php';
require_once '../modules/User/UserModel.php';

Session::start();

// بررسی ورود کاربر
if (!Session::has('user_id')) {
    redirect('login.php');
}

$userId = Session::get('user_id');
$userName = Session::get('user_name') ?? 'کاربر';

// نمونه‌سازی مدل User
$userModel = new UserModel();

// بررسی ارسال فرم اطلاعات
$updateMessage = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // آپلود عکس
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['name'] !== '') {
        $result = $userModel->updateProfileImage($userId, $_FILES['profile_image']);
        $updateMessage = $result ? "عکس پروفایل با موفقیت بروزرسانی شد." : "خطا در آپلود عکس. فقط jpg یا png مجاز است.";
    }
    
    // بروزرسانی اطلاعات پروفایل
    if (isset($_POST['name'])) {
        $data = [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'] ?? '',
            'address' => $_POST['address'] ?? '',
            'education' => $_POST['education'] ?? '',
            'position' => $_POST['position'] ?? ''
        ];
        $updateUser = $userModel->updateUserInfo($userId, $data);
        if ($updateUser) {
            $updateMessage = "اطلاعات پروفایل با موفقیت بروزرسانی شد.";
        } else {
            $updateMessage = "خطا در بروزرسانی اطلاعات پروفایل.";
        }
    }
}

// گرفتن اطلاعات فعلی کاربر
$userInfo = $userModel->getUserInfo($userId);
$profileImage = $userModel->getProfileImage($userId);
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>پروفایل کاربر</title>
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazir-font@v30.0.0/dist/font-face.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <style>
        /* استایل پروفایل */
        .profile-container {
            max-width: 700px;
            margin: 50px auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.1);
        }
        .profile-container img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
        }
        .profile-container input[type="file"] {
            margin: 15px 0;
        }
        .profile-container button {
            background-color: #a31818;
            color: #fff;
            border: none;
            padding: 10px 25px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
        }
        .profile-container button:hover {
            background-color: #7d0000;
        }
        .profile-container .message {
            margin-top: 15px;
            color: green;
            font-weight: bold;
        }
        .profile-container form input, .profile-container form select {
            width: 100%;
            padding: 8px 10px;
            margin-bottom: 15px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }
        .profile-container h2 {
            margin-bottom: 20px;
            color: #b71c1c;
            text-align: center;
        }
        .profile-container label {
            display: block;
            text-align: right;
            font-weight: 600;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <h2>پروفایل <?php echo htmlspecialchars($userName); ?></h2>
        <img src="<?php echo htmlspecialchars($profileImage); ?>" alt="عکس پروفایل">

        <!-- فرم آپلود عکس -->
        <form method="POST" enctype="multipart/form-data">
            <label>آپلود عکس جدید:</label>
            <input type="file" name="profile_image" accept="image/png, image/jpeg">
            <button type="submit">آپلود</button>
        </form>

        <!-- فرم بروزرسانی اطلاعات -->
        <form method="POST">
            <label>نام کامل:</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($userInfo['name'] ?? ''); ?>" required>

            <label>ایمیل:</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($userInfo['email'] ?? ''); ?>" required>

            <label>شماره همراه:</label>
            <input type="text" name="phone" value="<?php echo htmlspecialchars($userInfo['phone'] ?? ''); ?>">

            <label>آدرس:</label>
            <input type="text" name="address" value="<?php echo htmlspecialchars($userInfo['address'] ?? ''); ?>">

            <label>تحصیلات:</label>
            <input type="text" name="education" value="<?php echo htmlspecialchars($userInfo['education'] ?? ''); ?>">

            <label>سمت:</label>
            <input type="text" name="position" value="<?php echo htmlspecialchars($userInfo['position'] ?? ''); ?>">

            <button type="submit">بروزرسانی اطلاعات</button>
        </form>

        <?php if($updateMessage): ?>
            <div class="message"><?php echo htmlspecialchars($updateMessage); ?></div>
        <?php endif; ?>
    </div>
</body>
</html>
