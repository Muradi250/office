<?php
// public/api/login.php

// تنظیم مسیرهای پایه پروژه
require_once __DIR__ . '/../../config/config.php';
require_once BASE_PATH . '/modules/User/UserController.php';

// تنظیم هدر پاسخ JSON
header('Content-Type: application/json; charset=utf-8');

// فقط درخواست POST رو قبول کنیم
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['success' => false, 'message' => 'درخواست نامعتبر است']);
    exit;
}

// دریافت ورودی JSON از بدنه درخواست
$input = json_decode(file_get_contents('php://input'), true);

if (!$input) {
    http_response_code(400); // Bad Request
    echo json_encode(['success' => false, 'message' => 'داده‌های ورودی نامعتبر است']);
    exit;
}

// ایجاد کنترلر و پردازش لاگین
$controller = new UserController();
$response = $controller->loginApi($input);

// پاسخ JSON را ارسال کن
echo json_encode($response);
