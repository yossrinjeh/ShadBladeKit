# 🚀 ShadBladeKit

**The Ultimate Laravel 11 Starter Kit — Enterprise Features, Modern UI, and Developer Superpowers**

<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="380" alt="Laravel Logo">
</p>

<p align="center">
  <a href="https://github.com/yossrinjeh/ShadBladeKit"><img src="https://img.shields.io/badge/Laravel-11-FF2D20?style=for-the-badge&logo=laravel" /></a>
  <a href="#"><img src="https://img.shields.io/badge/PHP-8.3+-777BB4?style=for-the-badge&logo=php" /></a>
  <a href="https://github.com/yossrinjeh/ShadBladeKit/stargazers"><img src="https://img.shields.io/github/stars/yossrinjeh/ShadBladeKit?style=for-the-badge&logo=github" /></a>
  <a href="https://shadbladekit.yosridev.com"><img src="https://shadbladekit.yosridev.com/storage/logos/1763837666_692206e2da5c3.png" /></a>
</p>

---

# 🎯 Overview

**ShadBladeKit** is a premium-quality Laravel 11 starter kit built to eliminate boilerplate and boost productivity.  
It combines:

- Enterprise-grade security  
- Modern Shadcn-inspired Blade UI  
- A complete CRUD generator  
- Multi-language support with RTL  
- Theme presets + custom theming  
- Analytics and dashboards  
- A stunning command palette  
- A fully customizable, scalable architecture  

Perfect for:

- SaaS Applications  
- Internal Dashboards  
- Admin Panels  
- Enterprise Workflows  
- Multilingual Platforms  

---

# 🎮 Live Demo

👉 **https://shadbladekit.yosridev.com**

---

# ✨ Features

## 🔐 Authentication & Security
- Login / Register / Reset Password
- Email Verification
- Two-Factor Authentication (TOTP)
- Recovery Codes
- Role & Permission System (Spatie)
- Activity Logs
- Session Management

## 👥 User Management
- Full CRUD (modal based)
- Bulk Actions
- Search + Filters
- Avatar Upload
- Role Assignment
- Export / Import Ready

## 🎨 Modern UI/UX (Shadcn-Inspired)
- Custom Blade UI Components
- 5 Theme Presets
- Custom Color Editor
- Live Preview
- Dark / Light Mode
- Fully Responsive
- Command Palette (Ctrl + K)

## 🌍 Multilingual
- English
- French
- Spanish
- Arabic (RTL)
- Auto-detected & switchable

## 📊 Analytics Dashboard
- KPI Widgets
- User Growth
- Recent Activity Timeline
- Role Distribution Graphs

## ⚡ CRUD Generator
```bash
php artisan create:crud Post
```
Generates:

- Migration  
- Model  
- Controller  
- Form Request  
- Views  
- Routes  
- Permissions  
- Sidebar link  
- Translations  

All automatically.

---

# 🛠️ Tech Stack

- Laravel 11  
- PHP 8.3+  
- Blade  
- Tailwind CSS  
- Alpine.js  
- Vite  
- MySQL / PostgreSQL  
- Chart.js  
- Spatie Permissions  

---

# 📸 Screenshots (Add yours here)

> These are empty placeholders so you can insert real screenshots later.

| Dashboard | User Management |
|----------|------------------|
| `screenshot_dashboard_here` | `screenshot_users_here` |

| Theme System | Command Palette |
|--------------|------------------|
| `screenshot_themes_here` | `screenshot_palette_here` |

---

# 🚀 Installation

```bash
git clone https://github.com/yossrinjeh/ShadBladeKit.git
cd ShadBladeKit

composer install
npm install

cp .env.example .env
php artisan key:generate

php artisan migrate --seed

npm run build
php artisan serve
```

---

# 🔑 Default Credentials

| Role | Email | Password |
|------|--------|----------|
| Admin | admin@example.com | password |
| User | user@example.com | password |

---

# 📁 Project Structure

```
ShadBladeKit/
├── app/
│   ├── Console/Commands/
│   ├── Http/Controllers/
│   ├── Models/
├── resources/
│   ├── views/
│   ├── lang/
│   ├── components/ui/
├── database/
│   ├── migrations/
│   ├── seeders/
└── routes/
    ├── web.php
    └── auth.php
```

---

# 🗺️ Roadmap

### ✅ v1.0 — Current Release
- Authentication
- CRUD Generator
- Themes
- Middleware
- Profiles
- Command Palette
- Analytics

### 🚀 v1.1 — Coming Soon
- API (Sanctum)
- File Manager
- Email Templates
- Backup System
- Queue Monitor

### 🌟 v1.2 — Future
- Multi-tenancy
- Notification Center
- Payments
- Plugin System

---

# 🤝 Contributing

1. Fork  
2. Create a feature branch  
3. Commit  
4. Open PR  

---

# 👨‍💻 Author

**Yossri Njeh**  
Email: **yossri.njeh@example.com**  
GitHub: https://github.com/yossrinjeh

---

# ⭐ Support the Project

If you like ShadBladeKit, give it a ⭐ on GitHub!

<p align="center">
  <a href="https://github.com/yossrinjeh/ShadBladeKit/stargazers">
    <img src="https://img.shields.io/github/stars/yossrinjeh/ShadBladeKit?style=social" />
  </a>
</p>

<p align="center"><strong>Built with ❤️ for the Laravel community</strong></p>
