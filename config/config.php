
<?php
define('BASE_PATH', realpath(__DIR__ . '/../'));


// -------------------------
// 🔧 تنظیمات عمومی پروژه
// -------------------------

// تنظیم منطقه زمانی پیش‌فرض
date_default_timezone_set('Asia/Tehran'); // یا هر منطقه زمانی دلخواه

// شروع سشن اگر هنوز شروع نشده
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// تعریف مسیرهای ثابت برای پروژه
define('BASE_URL', 'http://localhost/login-system/public/');  // آدرس پایه پروژه
define('ASSETS_URL', BASE_URL . 'assets/');          // مسیر دسترسی به فایل‌های CSS, JS, تصاویر
// وضعیت دیباگ (برای نمایش خطاها)
define('DEBUG_MODE', true);

// اگر دیباگ فعال است، خطاها را نمایش بده
if (DEBUG_MODE) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
} else {
    // در حالت غیرفعال، خطاها را پنهان کن (برای محیط واقعی)
    ini_set('display_errors', 0);
    error_reporting(0);
}

// 📌 فایل اتصال به دیتابیس را بارگذاری کن
require_once __DIR__ . '/database.php';
?>
