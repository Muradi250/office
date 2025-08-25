<?php
// 📤 خروج کاربر از سیستم

require_once '../config/config.php';
require_once '../core/Session.php';
require_once '../core/Helpers.php';

// شروع سشن اگر فعال نیست
Session::start();

// پاک کردن تمام اطلاعات سشن
Session::destroy();

// هدایت به صفحه ورود
redirect('login.php');
