<?php
require_once __DIR__ . '/../../../config/config.php';
require_once __DIR__ . '/../../../core/Database.php';
require_once __DIR__ . '/../../../core/Session.php';


Session::start();
$userId = Session::get('user_id');

// اتصال به دیتابیس
$db = new Database();

// کارهای من
$myTasks = $db->query("SELECT title FROM tasks WHERE user_id = ? AND status = 'pending'", [$userId]);

// پیام‌های دریافتی خوانده نشده
$messages = $db->query("SELECT message FROM messages WHERE to_user_id = ? AND is_read = 0", [$userId]);

// فعالیت‌های اخیر (مثلا ۵ مورد آخر)
$recentActivities = $db->query("SELECT activity_text FROM activities WHERE user_id = ? ORDER BY created_at DESC LIMIT 5", [$userId]);

// وظایف تیمی (فرض می‌کنیم تیم کاربر در session است)
$teamId = Session::get('team_id');
$teamTasks = $db->query("SELECT title FROM team_tasks WHERE team_id = ? AND status = 'pending'", [$teamId]);
?>

<div class="dashboard-right">
    <section class="card my-tasks">
        <h3>کارهای من</h3>
        <ul>
            <?php foreach ($myTasks as $task): ?>
                <li><?= htmlspecialchars($task['title']) ?></li>
            <?php endforeach; ?>
            <?php if (empty($myTasks)) echo '<li>کار فعالی وجود ندارد.</li>'; ?>
        </ul>
    </section>

    <section class="card messages">
        <h3>پیغام‌ها</h3>
        <ul>
            <?php foreach ($messages as $msg): ?>
                <li><?= htmlspecialchars($msg['message']) ?></li>
            <?php endforeach; ?>
            <?php if (empty($messages)) echo '<li>پیامی وجود ندارد.</li>'; ?>
        </ul>
    </section>

    <section class="card recent-activity">
        <h3>فعالیت‌های اخیر</h3>
        <ul>
            <?php foreach ($recentActivities as $activity): ?>
                <li><?= htmlspecialchars($activity['activity_text']) ?></li>
            <?php endforeach; ?>
            <?php if (empty($recentActivities)) echo '<li>فعالیتی وجود ندارد.</li>'; ?>
        </ul>
    </section>

    <section class="card team-tasks">
        <h3>وظایف تیمی</h3>
        <ul>
            <?php foreach ($teamTasks as $teamTask): ?>
                <li><?= htmlspecialchars($teamTask['title']) ?></li>
            <?php endforeach; ?>
            <?php if (empty($teamTasks)) echo '<li>وظیفه‌ای برای تیم وجود ندارد.</li>'; ?>
        </ul>
    </section>
</div>
