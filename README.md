
# Xblog

Xblog হলো একটি Laravel ভিত্তিক ব্লগিং প্লাটফর্ম যেখানে ইউজার প্রোফাইল আপডেট, ক্যাটাগরি ম্যানেজমেন্ট, পোস্ট ম্যানেজমেন্ট, প্রোডাক্ট ম্যানেজমেন্ট ইত্যাদি রয়েছে।

---

## 📂 Project Setup

### ✅ Requirements:
- PHP >= 8.0
- Composer
- Node.js & NPM (যদি ফ্রন্টএন্ড বিল্ড প্রয়োজন হয়)
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
> `.env` ফাইলে তোমার লোকাল ডাটাবেস এর নাম, ইউজারনেম, পাসওয়ার্ড ঠিক করে দিও।

### 6. Generate App Key
```bash
php artisan key:generate
```

### 7. Import Database
> প্রজেক্টের `database` ফোল্ডারে দেওয়া `xblog.sql` ডাটাবেস ফাইল লোকাল MySQL-এ ইম্পোর্ট করতে হবে।

### 8. Run Migrations (if needed)
```bash
php artisan migrate
```
(যদি ডাটাবেস ডাম্প দেওয়া থাকে, এই ধাপ প্রয়োজন নাও হতে পারে।)

### 9. Run Project
```bash
php artisan serve
```
প্রজেক্ট চলবে এই ঠিকানায়: [http://localhost:8000](http://localhost:8000)

---

## ✅ Special Notes:
- প্রজেক্টের notification system-এর জন্য `toastr.js` CDN যুক্ত করতে হবে। (এই প্রজেক্টে ইতোমধ্যে যুক্ত আছে)
- ইউজার প্রোফাইল আপডেটের পরে toastr notification কাজ করবে।
- লগইন সিস্টেম Laravel Breeze বা অন্য কোনো প্যাকেজ দিয়ে ইমপ্লিমেন্ট করা থাকতে পারে। যদি না থাকে, আগে authentication সিস্টেম যোগ করো।

---

## ⚙️ Useful Commands

### যদি কোডে নতুন কিছু যোগ করো:
```bash
git add .
git commit -m "Your update message"
git push
```

### যদি CSS/JS compile করতে হয়:
```bash
npm run dev
```

---

## 🔥 Project Developed By:
**Utpal Chandra Das**  
[My Fiverr Profile](https://www.fiverr.com/s/kLjBl4A)

---

## ❤️ Feel free to contribute or ask for support anytime!

---