<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/UserModel.php'; // حتماً require_once
require_once __DIR__ . '/../../core/Session.php';
require_once __DIR__ . '/../../core/Validator.php';
require_once __DIR__ . '/../../core/Helpers.php';

class UserController {
    private $model;

    public function __construct() {
        $this->model = new UserModel();
        Session::start();
    }

    // متد لاگین معمولی (با ریدایرکت)
    public function login($data) {
        $email = sanitize($data['email'] ?? '');
        $password = $data['password'] ?? '';

        if (!Validator::notEmpty($email) || !Validator::notEmpty($password)) {
            return displayError("تمام فیلدها الزامی هستند.");
        }

        if (!Validator::email($email)) {
            return displayError("ایمیل وارد شده معتبر نیست.");
        }

        $user = $this->model->checkLogin($email, $password);
        if ($user) {
            // ست کردن سشن‌ها
            Session::set('user_id', $user['id']);
            Session::set('user_name', $user['name']);
            Session::set('profile_image', !empty($user['profile_image']) ? $user['profile_image'] : 'assets/images/user.png');

            redirect('dashboard.php');
        } else {
            return displayError("اطلاعات ورود نادرست است.");
        }
    }

    // متد ثبت‌نام
    public function register($data) {
        $name = sanitize($data['name'] ?? '');
        $email = sanitize($data['email'] ?? '');
        $password = $data['password'] ?? '';
        $confirm = $data['confirm'] ?? '';

        if (!Validator::notEmpty($name) || !Validator::notEmpty($email) || !Validator::notEmpty($password)) {
            return displayError("تمام فیلدها الزامی هستند.");
        }

        if (!Validator::email($email)) {
            return displayError("ایمیل وارد شده معتبر نیست.");
        }

        if (!Validator::minLength($password, 6)) {
            return displayError("رمز عبور باید حداقل ۶ کاراکتر باشد.");
        }

        if (!Validator::matches($password, $confirm)) {
            return displayError("رمز عبور و تکرار آن یکسان نیستند.");
        }

        if ($this->model->emailExists($email)) {
            return displayError("ایمیل قبلاً ثبت شده است.");
        }

        $success = $this->model->register($name, $email, $password);
        if ($success) {
            return displaySuccess("ثبت‌نام با موفقیت انجام شد. حالا وارد شوید.");
        } else {
            return displayError("خطا در ثبت‌نام. لطفاً دوباره تلاش کنید.");
        }
    }

    // متد لاگین برای AJAX / API
    public function loginApi($data) {
        $email = sanitize($data['email'] ?? '');
        $password = $data['password'] ?? '';

        if (!Validator::notEmpty($email) || !Validator::notEmpty($password)) {
            return ['success' => false, 'message' => 'تمام فیلدها الزامی هستند.'];
        }

        if (!Validator::email($email)) {
            return ['success' => false, 'message' => 'ایمیل وارد شده معتبر نیست.'];
        }

        $user = $this->model->checkLogin($email, $password);
        if ($user) {
            // ست کردن سشن‌ها
            Session::set('user_id', $user['id']);
            Session::set('user_name', $user['name']);
            Session::set('profile_image', !empty($user['profile_image']) ? $user['profile_image'] : 'assets/images/user.png');

            return ['success' => true, 'message' => 'ورود موفق بود.'];
        } else {
            return ['success' => false, 'message' => 'اطلاعات ورود نادرست است.'];
        }
    }

}
?>
