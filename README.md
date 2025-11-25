# 🚀 ShadBladeKit

**The Ultimate Laravel 11 Starter Kit — Enterprise Features, Modern UI, and Developer Superpowers**

<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="380" alt="Laravel Logo">
</p>

<p align="center">
  <a href="https://github.com/yossrinjeh/ShadBladeKit/blob/master/LICENSE"><img src="https://img.shields.io/badge/License-MIT-green?style=for-the-badge" 
  style="height:20px;"
  /></a>
  <a href="https://github.com/yossrinjeh/ShadBladeKit/stargazers"><img src="https://img.shields.io/github/stars/yossrinjeh/ShadBladeKit?logo=github" /></a>
  <a href="https://github.com/yossrinjeh/ShadBladeKit/releases"><img src="https://img.shields.io/github/v/release/yossrinjeh/ShadBladeKit?logo=github" /></a>
  <a href="https://laravel.com/"><img src="https://img.shields.io/badge/Laravel-11-FF2D20?logo=laravel" /></a>
  <a href="https://www.php.net/"><img src="https://img.shields.io/badge/PHP-8.3%2B-777BB4?logo=php" /></a>
  <a href="https://github.com/yossrinjeh/ShadBladeKit/commits/master"><img src="https://img.shields.io/github/last-commit/yossrinjeh/ShadBladeKit?logo=git" /></a>
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

## ⚡ CRUD Generator in Action

<p align="center">
  <img src="https://shadbladekit.yosridev.com/storage/captures/ezgif-6d5cd9f8392749c7.gif" alt="CRUD Generator Demo" width="800">
</p>

> **One Command = Complete Feature** - Watch how `php artisan create:crud Post` generates everything you need!

---

# ✨ Features

## 🔐 Authentication & Security
- **Complete Auth System**: Login, Register, Reset Password
- **Email Verification**: Secure account activation
- **Two-Factor Authentication (TOTP)**: Enhanced security
- **Recovery Codes**: Backup authentication method
- **Role & Permission System**: Spatie-powered access control
- **Activity Logs**: Comprehensive audit trails
- **Session Management**: Secure session handling

## 👥 User Management
- **Advanced CRUD**: Modal-based interface
- **Bulk Operations**: Mass user actions
- **Smart Search & Filters**: Advanced user discovery
- **Avatar Upload**: Profile image management
- **Role Assignment**: Flexible permission system
- **Export / Import**: Data portability

## 🎨 Modern UI/UX (Shadcn-Inspired)
- **Custom Blade Components**: Reusable UI elements
- **5 Theme Presets**: Professional color schemes
- **Custom Color Editor**: Brand customization
- **Live Preview**: Real-time theme changes
- **Dark / Light Mode**: Automatic theme switching
- **100% RTL Support**: Right-to-left layouts
- **Fully Responsive**: Mobile-first design
- **Command Palette**: Ctrl+K quick navigation

## 🌐 Translation Management System
- **AI-Powered Translation**: Gemini 2.0 Flash integration
- **Admin Interface**: Complete translation management
- **Auto-Sync System**: Missing key detection
- **File-Based Storage**: High-performance translations
- **4 Languages**: EN, FR, ES, AR with RTL support
- **Intelligent Fallbacks**: English fallback system

## 🌍 Multilingual & Translation Management
- **4 Languages**: English, French, Spanish, Arabic (RTL)
- **AI-Powered Translation**: Gemini 2.0 Flash API integration
- **Translation Management System**: Complete admin interface
- **Auto-Sync**: Intelligent detection of missing translation keys
- **100% RTL Support**: Full right-to-left layout support
- **File-Based System**: High-performance translation storage
- **Auto-detected & switchable**: Smart language detection

## 📊 Analytics Dashboard
- KPI Widgets
- User Growth
- Recent Activity Timeline
- Role Distribution Graphs

## ⚡ CRUD Generator
```bash
php artisan create:crud Post
```
**Generates Everything Automatically:**

- ✅ **Migration** (database table)
- ✅ **Model** (Eloquent model)
- ✅ **Controller** (full CRUD logic)
- ✅ **Form Request** (validation rules)
- ✅ **Views** (modal-based interface)
- ✅ **Routes** (protected with permissions)
- ✅ **Permissions** (role-based access)
- ✅ **Sidebar Navigation** (auto-updated)
- ✅ **Translation Keys** (multilingual ready)

**One Command = Complete Feature**

---

# 📸 Screenshots

| Dashboard | User Management |
|----------|------------------|
| ![Dashboard](https://shadbladekit.yosridev.com/storage/captures/dash.PNG) | ![Roles Management](https://shadbladekit.yosridev.com/storage/captures/roles.PNG) |

| Theme System | Command Palette |
|--------------|------------------|
| ![Theme Presets](https://shadbladekit.yosridev.com/storage/captures/thems.PNG) | ![Command Palette](https://shadbladekit.yosridev.com/storage/captures/palette.PNG) |

| Custom Theming | Translation Management |
|----------------|------------------------|
| ![Custom Colors](https://shadbladekit.yosridev.com/storage/captures/custom.PNG) | ![AI Translation](https://shadbladekit.yosridev.com/storage/captures/translate.PNG) |

| Welcome Page | Settings Panel |
|--------------|----------------|
| ![Home Page](https://shadbladekit.yosridev.com/storage/captures/home.PNG) | ![Settings](https://shadbladekit.yosridev.com/storage/captures/sett.PNG) |

| Activity Logs | UI Components |
|---------------|---------------|
| ![Activity Logs](https://shadbladekit.yosridev.com/storage/captures/log.PNG) | ![Components](https://shadbladekit.yosridev.com/storage/captures/comp.PNG) |

| RTL Support | Add Role |
|-------------|----------|
| ![RTL Layout](https://shadbladekit.yosridev.com/storage/captures/rtl.PNG) | ![Add Role](https://shadbladekit.yosridev.com/storage/captures/add%20role.PNG) |

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
- **Authentication & Security**: Complete 2FA system
- **CRUD Generator**: One-command full CRUD generation
- **Translation System**: AI-powered multilingual management
- **RTL Support**: 100% right-to-left layout compatibility
- **Theme System**: 5 presets + custom color management
- **User Management**: Advanced CRUD with bulk operations
- **Command Palette**: Ctrl+K quick navigation
- **Analytics Dashboard**: Real-time KPIs and charts

### 🚀 v1.1 — Coming Soon
- **API System**: Laravel Sanctum integration
- **File Manager**: Advanced file handling
- **Email Templates**: Customizable notifications
- **Backup System**: Automated data backups
- **Queue Monitor**: Background job tracking
- **Advanced Analytics**: Enhanced reporting

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
