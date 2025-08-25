<?php
// 📦 ProfileModel.php
// مدل مربوط به مدیریت پروفایل کاربران

require_once __DIR__ . '/../../core/Database.php';

class ProfileModel {
    private $conn;

    public function __construct() {
        // اتصال به دیتابیس
        $db = new Database();
        $this->conn = $db->connect();
    }

    /**
     * دریافت اطلاعات پروفایل کاربر بر اساس آیدی
     * @param int $userId
     * @return array|false
     */
    public function getProfile($userId) {
        $sql = "SELECT id, name, email, profile_image FROM users WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * آپدیت اطلاعات عمومی پروفایل کاربر
     * @param int $userId
     * @param string $name
     * @param string $email
     * @return bool
     */
    public function updateProfile($userId, $name, $email) {
        $sql = "UPDATE users SET name = :name, email = :email WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /**
     * آپدیت عکس پروفایل کاربر
     * @param int $userId
     * @param string $filename
     * @return bool
     */
    public function updateProfileImage($userId, $filename) {
        $sql = "UPDATE users SET profile_image = :profile_image WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':profile_image', $filename);
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
