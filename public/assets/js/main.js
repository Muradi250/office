// main.js - کدهای عمومی و پایه سایت

console.log("main.js بارگذاری شد.");

// ارسال فرم ورود با AJAX
document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.querySelector('.login-container form');
    const messageDiv = document.getElementById('message');

    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault(); // جلوگیری از ارسال معمولی فرم

            const formData = new FormData(loginForm);
            const data = {};

            formData.forEach((value, key) => {
                data[key] = value;
            });

            // مسیر مطلق بر اساس محل نصب پروژه
            const apiUrl = window.location.origin + '/login-system/public/api/login.php';

            fetch(apiUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    if (messageDiv) {
                        messageDiv.style.color = 'green';
                        messageDiv.textContent = result.message;
                    } else {
                        alert(result.message);
                    }
                    // هدایت به صفحه خوشامدگویی
                    console.log('هدایت به welcome.php شروع شد');
                    window.location.href = '/login-system/public/welcome.php';
                } else {
                    if (messageDiv) {
                        messageDiv.style.color = 'red';
                        messageDiv.textContent = result.message;
                    } else {
                        alert(result.message);
                    }
                }
            })
            .catch(error => {
                console.error('خطا در ارسال فرم:', error);
                if (messageDiv) {
                    messageDiv.style.color = 'red';
                    messageDiv.textContent = 'خطا در ارسال درخواست، دوباره تلاش کنید.';
                } else {
                    alert('خطا در ارسال درخواست، دوباره تلاش کنید.');
                }
            });
        });
    }
});
