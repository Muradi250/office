<?php
require_once __DIR__ . '/modules/User/UserModel.php';

// ساختن آبجکت مدل
$userModel = new UserModel();

// شناسه کاربری که می‌خوای تست کنی (id از جدول users بگیر)
$userId = 1;

// داده‌های آزمایشی
$data = [
    'name' => 'Ahmad Test',
    'email' => 'ahmad@test.com',
    'phone' => '123456789',
    'address' => 'Kabul, Afghanistan',
    'education' => 'Bachelor of Computer Science',
    'position' => 'Full Stack Developer'
];

// اجرای آپدیت
if ($userModel->updateUserInfo($userId, $data)) {
    echo "✅ پروفایل با موفقیت آپدیت شد.";
} else {
    echo "❌ خطا در آپدیت پروفایل.";
}
