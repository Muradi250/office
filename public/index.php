<?php
// public/index.php

require_once '../config/config.php';
require_once '../core/Session.php';
require_once '../core/Helpers.php';

// شروع سشن
Session::start();

// اگر کاربر وارد نشده بود، هدایت به صفحه ورود
if (!Session::has('user_id')) {
    redirect('login.php');
} else {
    // اگر وارد شده بود، هدایت به داشبورد
    redirect('dashboard.php');
}
