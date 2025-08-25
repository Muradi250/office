<?php
// 🎯 کلاس Router برای مدیریت مسیرها (روتینگ ساده)

class Router {
    private $routes = [];

    /**
     * ثبت یک مسیر و تابع فراخوانی
     * @param string $path
     * @param callable $callback
     */
    public function add($path, $callback) {
        $this->routes[$path] = $callback;
    }

    /**
     * اجرای روتینگ بر اساس آدرس درخواست شده
     */
    public function run() {
        // مسیر درخواستی را می‌گیریم (بدون پارامتر GET)
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // حذف آدرس پایه اگر نیاز باشه (مثلاً localhost/login-system/)
        $basePath = parse_url(BASE_URL, PHP_URL_PATH);
        if (strpos($uri, $basePath) === 0) {
            $uri = substr($uri, strlen($basePath));
        }

        // مسیر تهی یعنی صفحه اصلی
        if ($uri === '') {
            $uri = '/';
        }

        // چک کردن وجود مسیر در آرایه
        if (array_key_exists($uri, $this->routes)) {
            call_user_func($this->routes[$uri]);
        } else {
            // اگر مسیر تعریف نشده، خطای 404 نمایش بده
            http_response_code(404);
            echo "صفحه مورد نظر یافت نشد.";
        }
    }
}
