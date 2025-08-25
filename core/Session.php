<?php
// 🧠 کلاس Session برای مدیریت سشن کاربران به‌صورت حرفه‌ای

class Session {

    /**
     * شروع سشن (اگر هنوز شروع نشده)
     */
    public static function start() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * مقداردهی به یک متغیر سشن
     * @param string $key
     * @param mixed $value
     */
    public static function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    /**
     * دریافت مقدار از سشن
     * @param string $key
     * @return mixed|null
     */
    public static function get($key) {
        return $_SESSION[$key] ?? null;
    }

    /**
     * بررسی وجود یک کلید در سشن
     * @param string $key
     * @return bool
     */
    public static function has($key) {
        return isset($_SESSION[$key]);
    }

    /**
     * حذف یک متغیر از سشن
     * @param string $key
     */
    public static function remove($key) {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    /**
     * پایان دادن کامل به سشن
     */
    public static function destroy() {
        session_unset();     // حذف تمام مقادیر
        session_destroy();   // پایان دادن کامل
    }
}
?>
