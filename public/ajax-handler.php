<?php
// public/ajax-handler.php

header('Content-Type: application/json; charset=utf-8');

require_once '../config/config.php';
require_once '../core/Session.php';

Session::start();

if (!Session::has('user_id')) {
    http_response_code(403);
    echo json_encode(['error' => 'دسترسی غیرمجاز']);
    exit;
}

// دریافت اکشن ارسالی
$action = $_POST['action'] ?? '';

switch ($action) {
    case 'ping':
        // تست اتصال
        echo json_encode(['status' => 'ok', 'message' => 'اتصال برقرار است']);
        break;

    // اینجا می‌تونی اکشن‌های دیگه اضافه کنی، مثلاً ارسال پیام، ثبت کار و ...

    default:
        http_response_code(400);
        echo json_encode(['error' => 'درخواست نامعتبر']);
        break;
}
