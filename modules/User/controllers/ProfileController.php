<?php
require_once __DIR__ . '/UserModel.php';
require_once __DIR__ . '/../../core/Session.php';
require_once __DIR__ . '/../../core/Helpers.php';

Session::start();

if (!Session::has('user_id')) {
    header('Location: ../../public/login.php');
    exit;
}

$model = new UserModel();

if (isset($_POST['update_profile'])) {
    $user_id = Session::get('user_id');
    $name = sanitize($_POST['name'] ?? '');
    $phone = sanitize($_POST['phone'] ?? '');
    $email = sanitize($_POST['email'] ?? '');
    $profile_image_path = null;

    // آپلود عکس
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === 0) {
        $uploadDir = '../../public/uploads/avatars/';
        $fileName = time() . '_' . basename($_FILES['profile_image']['name']);
        $targetFile = $uploadDir . $fileName;

        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $targetFile)) {
            $profile_image_path = 'uploads/avatars/' . $fileName;
        }
    }

    // بروزرسانی دیتابیس
    $model->updateProfile($user_id, $name, $phone, $email, $profile_image_path);

    // آپدیت سشن‌ها
    Session::set('user_name', $name);
    if (!empty($profile_image_path)) {
        Session::set('profile_image', $profile_image_path);
    }

    header('Location: ../../public/profile.php');
    exit;
}
