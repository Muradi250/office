<?php
// 💾 کلاس Database مرکزی برای اتصال به دیتابیس با PDO
// این نسخه شامل connect(), query(), execute() است و با پروژه بزرگ سازگار است

if (!class_exists('Database')) {

    class Database {
        private $conn;

        private $host = 'localhost';
        private $dbname = 'login_project';
        private $username = 'root';
        private $password = '';
        private $charset = 'utf8';

        public function __construct() {
            $this->connect();
        }

        // متد اتصال به دیتابیس
        public function connect() {
            if ($this->conn === null) {
                $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset={$this->charset}";
                $options = [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ];

                try {
                    $this->conn = new PDO($dsn, $this->username, $this->password, $options);
                } catch (PDOException $e) {
                    die("خطا در اتصال به دیتابیس: " . $e->getMessage());
                }
            }
            return $this->conn;
        }

        // اجرای SELECT و دریافت نتایج
        public function query(string $sql, array $params = []) {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll();
        }

        // اجرای INSERT, UPDATE, DELETE
        public function execute(string $sql, array $params = []) {
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute($params);
        }
    }

}
?>
