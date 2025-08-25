// ajax.js - مدیریت درخواست‌های AJAX

// نمونه ارسال فرم ثبت‌نام با AJAX
function sendRegistrationForm(formId) {
    const form = document.getElementById(formId);
    if (!form) return;

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(form);

        fetch('ajax-handler.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            console.log("پاسخ سرور:", data);
            // می‌توانی اینجا پیغام نمایش بدی یا فرم رو ریست کنی
        })
        .catch(error => console.error('خطا در ارسال AJAX:', error));
    });
}
// مدیریت درخواست‌های AJAX
