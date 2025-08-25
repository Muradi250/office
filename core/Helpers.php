<?php
// ⚙️ توابع کمکی عمومی برای استفاده در سراسر پروژه

/**
 * ریدایرکت به آدرس مشخص شده
 * @param string $url
 */
function redirect($url) {
    header("Location: $url");
    exit();
}

/**
 * پاکسازی داده ورودی برای جلوگیری از XSS و کد مخرب
 * @param string $data
 * @return string
 */
function sanitize($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

/**
 * نمایش پیغام خطا به صورت امن و استاندارد
 * @param string $message
 * @return string
 */
function displayError($message) {
    return '<div class="error-message" style="color: red; font-weight: bold;">' . sanitize($message) . '</div>';
}

/**
 * نمایش پیغام موفقیت به صورت امن و استاندارد
 * @param string $message
 * @return string
 */
function displaySuccess($message) {
    return '<div class="success-message" style="color: green; font-weight: bold;">' . sanitize($message) . '</div>';
}

/**
 * تابع ساده برای لاگ کردن پیام در فایل log.txt
 * @param string $message
 */
function logMessage($message) {
    $logFile = __DIR__ . '/../logs/log.txt';
    $time = date('Y-m-d H:i:s');
    $formattedMessage = "[$time] $message" . PHP_EOL;
    file_put_contents($logFile, $formattedMessage, FILE_APPEND);
}
?>
