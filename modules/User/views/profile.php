<?php
require_once '../../core/Session.php';
require_once '../../modules/User/UserModel.php';
require_once '../../core/Helpers.php';

Session::start();

if (!Session::has('user_id')) {
    header('Location: ../../public/login.php');
    exit;
}

$user_id = Session::get('user_id');
$user_model = new UserModel();
$user = $user_model->getUserById($user_id);

$user_name = Session::get('user_name');
$profile_image = Session::get('profile_image') ?? 'assets/images/user.png';
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>پروفایل من</title>
    <link rel="stylesheet" href="../../public/assets/css/dashboard.css">
    <style>
        .profile-container { max-width: 500px; margin: 30px auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; }
        .profile-container label { display: block; margin-top: 10px; }
        .profile-container input { width: 100%; padding: 8px; margin-top: 5px; }
        .profile-container .avatar img { width: 100px; height: 100px; border-radius: 50%; object-fit: cover; margin-bottom: 10px; }
        .profile-container button { margin-top: 15px; padding: 10px 15px; }
    </style>
</head>
<body>

<h2>پروفایل من</h2>

<div class="profile-container">
    <form action="../../modules/User/controllers/ProfileController.php" method="post" enctype="multipart/form-data">
        <div class="avatar">
            <img src="<?= htmlspecialchars($profile_image) ?>" alt="User">
            <input type="file" name="profile_image" accept="image/*">
        </div>

        <label>نام کامل:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($user['name'] ?? '') ?>">

        <label>شماره همراه:</label>
        <input type="text" name="phone" value="<?= htmlspecialchars($user['phone'] ?? '') ?>">

        <label>ایمیل:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>">

        <button type="submit" name="update_profile">ذخیره تغییرات</button>
    </form>
</div>

</body>
</html>
