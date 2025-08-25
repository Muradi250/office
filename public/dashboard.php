<?php
require_once '../config/config.php';
require_once '../core/Session.php';
require_once '../core/Helpers.php';

Session::start();

if (!Session::has('user_id')) {
    redirect('login.php');
}

$userName = Session::get('user_name') ?? 'کاربر';
$profileImage = Session::get('profile_image') ?? 'assets/images/user.png';
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8" />
    <title>داشبورد اداری</title>
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazir-font@v30.0.0/dist/font-face.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/dashboard.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>
<body>
    <!-- Topbar -->
    <div class="topbar">
        <div class="logo">
            <img src="assets/images/logo4.png" alt="logo" />
            <span>سامانه اداری آریا شیمی</span>
        </div>
        <div class="topbar-actions">
            <div class="search-box">
                <input type="text" placeholder="جستجو..." />
                <i class="fas fa-search"></i>
            </div>
            <div class="icons">
                <i class="fas fa-bell"></i>
                <i class="fas fa-expand" id="fullscreen-btn"></i>
            </div>
            <div class="user-info">
                <img src="<?= htmlspecialchars($profileImage) ?>" alt="User" />
                <span><?= htmlspecialchars($userName) ?></span>
            </div>
        </div>
    </div>

    <!-- Dashboard -->
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <ul class="menu">
                <li class="menu-title">اصلی</li>
                <li class="<?= $currentPage == 'dashboard.php' ? 'active' : '' ?>"><i class="fas fa-home"></i> داشبورد</li>
                <li class="<?= $currentPage == 'profile.php' ? 'active' : '' ?>"><i class="fas fa-user"></i> پروفایل</li>
                <li class="<?= $currentPage == 'messages.php' ? 'active' : '' ?>"><i class="fas fa-envelope"></i> پیام‌ها</li>
                <li class="<?= $currentPage == 'tasks.php' ? 'active' : '' ?>"><i class="fas fa-tasks"></i> وظایف</li>

                <li class="menu-title">گزارشات</li>
                <li class="<?= $currentPage == 'reports.php' ? 'active' : '' ?>"><i class="fas fa-chart-bar"></i> گزارشات</li>
                <li class="<?= $currentPage == 'approved_docs.php' ? 'active' : '' ?>"><i class="fas fa-file-circle-check"></i> اسناد تاییدی</li>
                <li class="<?= $currentPage == 'requested_docs.php' ? 'active' : '' ?>"><i class="fas fa-file-signature"></i> اسناد درخواستی</li>

                <li class="menu-title">مدیریت</li>
                <li class="<?= $currentPage == 'users.php' ? 'active' : '' ?>"><i class="fas fa-users-cog"></i> مدیریت کاربران</li>
                <li class="<?= $currentPage == 'projects.php' ? 'active' : '' ?>"><i class="fas fa-briefcase"></i> پروژه‌ها</li>
                <li class="<?= $currentPage == 'calendar.php' ? 'active' : '' ?>"><i class="fas fa-calendar"></i> تقویم سازمانی</li>
                <li class="<?= $currentPage == 'settings.php' ? 'active' : '' ?>"><i class="fas fa-cogs"></i> تنظیمات</li>

                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> خروج</a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <h1>خوش آمدید، <?= htmlspecialchars($userName) ?>!</h1>
            <p>به سیستم اتوماسیون سازمانی خوش آمدید. از منوی کناری برای دسترسی به بخش‌ها استفاده کنید.</p>

            <div class="dashboard-right">
                <?php include '../modules/User/views/dashboard_content.php'; ?>
            </div>
        </main>
    </div>

    <!-- JS -->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/sidebar.js"></script>
</body>
</html>
