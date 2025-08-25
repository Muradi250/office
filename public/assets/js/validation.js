// validation.js - اعتبارسنجی فرم‌ها (مثال ثبت‌نام)

// اعتبارسنجی ساده ایمیل و پسورد
function validateRegistrationForm() {
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value;
    const passwordConfirm = document.getElementById('password_confirm').value;

    if (!email) {
        alert("ایمیل را وارد کنید");
        return false;
    }
    if (!validateEmail(email)) {
        alert("ایمیل معتبر نیست");
        return false;
    }
    if (password.length < 6) {
        alert("رمز عبور باید حداقل ۶ کاراکتر باشد");
        return false;
    }
    if (password !== passwordConfirm) {
        alert("رمز عبور و تکرار آن مطابقت ندارند");
        return false;
    }
    return true;
}

// تابع کمکی اعتبارسنجی ایمیل
function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email.toLowerCase());
}
// اعتبارسنجی فرم‌ها
