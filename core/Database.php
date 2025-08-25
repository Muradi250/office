<?php
// 💾 کلاس Database برای مدیریت اتصال به پایگاه‌داده با PDO

if (!class_exists('Database')) {

    class Database {
        private $host = DB_HOST;         // از config/database.php
        private $dbname = DB_NAME;
        private $username = DB_USER;
        private $password = DB_PASS;

        private $conn;                   // نگهدارنده اتصال PDO

        public function connect() {
            $this->conn = null;

            try {
                $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset=utf8";
                $this->conn = new PDO($dsn, $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("❌ خطا در اتصال به دیتابیس: " . $e->getMessage());
            }

            return $this->conn;
        }
    }

}
?>
