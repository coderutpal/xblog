
# Xblog

Xblog is a Laravel-based blogging platform that includes user profile management, category management, post management, product management, and more.
---

## 📂 Project Setup

### ✅ Requirements:
- PHP >= 8.0
- Composer
- Node.js & NPM (for frontend build if needed)
- MySQL Database
- Laravel 10 (or compatible version)

---

## 🚀 Installation Steps

### 1. Clone the Project
```bash
git clone https://github.com/yourusername/Xblog.git
```

### 2. Go to the project directory
```bash
cd Xblog
```

### 3. Install PHP Dependencies
```bash
composer install
```

### 4. Install Node Dependencies (if needed)
```bash
npm install
```

### 5. Setup `.env` File
```bash
cp .env.example .env
```
> Update your `.env` file with local database name, username, and password.

### 6. Generate App Key
```bash
php artisan key:generate
```

### 7. Import Database
> Import the `xblog.sql` file located in the `database` folder into your MySQL database.

### 8. Run Migrations
```bash
php artisan migrate
```

### 9. Run Project
```bash
php artisan serve
```
Access the project here: [http://localhost:8000](http://localhost:8000)

---

## ✅ Special Notes:
- প্রজেক্টের notification system-এর জন্য `toastr.js` CDN যুক্ত করতে হবে। (এই প্রজেক্টে ইতোমধ্যে যুক্ত আছে)
- ইউজার প্রোফাইল আপডেটের পরে toastr notification কাজ করবে।
- লগইন সিস্টেম Laravel Breeze বা অন্য কোনো প্যাকেজ দিয়ে ইমপ্লিমেন্ট করা থাকতে পারে। যদি না থাকে, আগে authentication সিস্টেম যোগ করো।

---

## 🔥 Project Developed By:
**Utpal Chandra Das**  
📧 Email: utpoldas606@gmail.com
💬 WhatsApp: +880 1933871763
📘 Facebook: Utpal Chandra Das
🌍 Fiverr: My Fiverr Profile
[My Fiverr Profile](https://www.fiverr.com/s/kLjBl4A)

---

## ❤️ Feel free to contribute or ask for support anytime!

---
