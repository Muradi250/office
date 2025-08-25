<?php
// ✅ کلاس Validator برای اعتبارسنجی فرم‌ها و داده‌های ورودی

class Validator {

    /**
     * بررسی خالی نبودن مقدار
     * @param string $value
     * @return bool
     */
    public static function notEmpty($value) {
        return isset($value) && trim($value) !== '';
    }

    /**
     * بررسی معتبر بودن آدرس ایمیل
     * @param string $email
     * @return bool
     */
    public static function email($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    /**
     * بررسی طول حداقل یک رشته (مثلاً رمز عبور)
     * @param string $value
     * @param int $minLength
     * @return bool
     */
    public static function minLength($value, $minLength) {
        return mb_strlen(trim($value)) >= $minLength;
    }

    /**
     * بررسی طول حداکثر یک رشته
     * @param string $value
     * @param int $maxLength
     * @return bool
     */
    public static function maxLength($value, $maxLength) {
        return mb_strlen(trim($value)) <= $maxLength;
    }

    /**
     * بررسی تطابق دو مقدار (مثلاً رمز عبور و تکرارش)
     * @param mixed $value1
     * @param mixed $value2
     * @return bool
     */
    public static function matches($value1, $value2) {
        return trim($value1) === trim($value2);
    }

    /**
     * فیلتر و پاکسازی مقدار ورودی از کاراکترهای ناخواسته
     * @param string $value
     * @return string
     */
    public static function sanitize($value) {
        return htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');
    }
}
?>
