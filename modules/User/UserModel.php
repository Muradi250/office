<?php
// 📦 مدل User برای کار با پایگاه‌داده مربوط به کاربران
// شامل توابع ورود، ثبت‌نام، آپلود عکس و مدیریت اطلاعات پروفایل

require_once __DIR__ . '/../../config/config.php'; // مسیر اصلاح شده کانفیگ
require_once __DIR__ . '/../../core/Database.php'; // کلاس اتصال دیتابیس

class UserModel {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect(); // گرفتن اتصال PDO
    }

    /**
     * بررسی ورود کاربر
     */
    public function checkLogin($email, $password) {
        $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    /**
     * ثبت‌نام کاربر جدید
     */
    public function register($name, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        return $stmt->execute();
    }

    /**
     * بررسی وجود ایمیل
     */
    public function emailExists($email) {
        $sql = "SELECT id FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    /**
     * آپلود و بروزرسانی عکس پروفایل کاربر
     */
    public function updateProfileImage($userId, $file) {
        $uploadDir = __DIR__ . '/../../../public/uploads/profile/';

        // بررسی وجود پوشه و ایجاد آن با اجازه نوشتن
        if (!is_dir($uploadDir)) {
            if (!mkdir($uploadDir, 0755, true)) {
                return false; // اگر پوشه ساخته نشد
            }
        }

        // بررسی اجازه نوشتن
        if (!is_writable($uploadDir)) {
            return false; // پوشه قابل نوشتن نیست
        }

        // بررسی خطاهای آپلود
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return false;
        }

        // جلوگیری از تداخل نام فایل
        $filename = time() . '_' . basename($file['name']);
        $targetFile = $uploadDir . $filename;

        $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
        if (!in_array($file['type'], $allowedTypes)) return false;

        // انتقال فایل به مسیر نهایی
        if (move_uploaded_file($file['tmp_name'], $targetFile)) {
            $sql = "UPDATE users SET profile_image = :profile_image WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':profile_image', $filename);
            $stmt->bindParam(':id', $userId);
            $stmt->execute();
            return $filename;
        }

        return false;
    }

    /**
     * گرفتن مسیر عکس پروفایل کاربر
     */
    public function getProfileImage($userId) {
        $sql = "SELECT profile_image FROM users WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $userId);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && !empty($user['profile_image'])) {
            return 'public/uploads/profile/' . $user['profile_image'];
        }
        return 'assets/images/default_profile.png';
    }

    /**
     * گرفتن اطلاعات کامل پروفایل کاربر
     */
    public function getUserInfo($userId) {
        $sql = "SELECT * FROM users WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $userId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * بروزرسانی اطلاعات پروفایل کاربر
     */
    public function updateUserInfo($userId, $data) {
        $sql = "UPDATE users SET 
                    name = :name,
                    email = :email,
                    phone = :phone,
                    address = :address,
                    education = :education,
                    position = :position
                WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':phone', $data['phone']);
        $stmt->bindParam(':address', $data['address']);
        $stmt->bindParam(':education', $data['education']);
        $stmt->bindParam(':position', $data['position']);
        $stmt->bindParam(':id', $userId);
        return $stmt->execute();
    }
}
?>
