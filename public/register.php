<?php
// 🔧 بارگذاری تنظیمات اصلی پروژه (تعریف BASE_PATH و سایر تنظیمات)
require_once '../config/config.php';

// 📥 بارگذاری کنترلر و مدل کاربر
require_once '../config/config.php'; // بارگذاری تنظیمات اصلی
require_once BASE_PATH . '/modules/User/views/register.php'; // بارگذاری فرم اصلی ثبت‌نام
// 🎯 ایجاد شیء کنترلر
$controller = new UserController();

// 🔄 پردازش درخواست ثبت‌نام
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = $controller->register($_POST);
}
?>