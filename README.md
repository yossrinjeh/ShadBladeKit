# 🚀 ShadBladeKit

**The ultimate Laravel 11 starter kit for modern web applications**

<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
</p>

<p align="center">
  <a href="https://github.com/yossrinjeh/ShadBladeKit"><img src="https://img.shields.io/badge/Laravel-11-FF2D20?style=for-the-badge&logo=laravel" alt="Laravel 11"></a>
  <a href="https://github.com/yossrinjeh/ShadBladeKit"><img src="https://img.shields.io/badge/PHP-8.3+-777BB4?style=for-the-badge&logo=php" alt="PHP 8.3+"></a>
  <a href="https://github.com/yossrinjeh/ShadBladeKit/blob/main/LICENSE"><img src="https://img.shields.io/badge/License-MIT-green?style=for-the-badge" alt="MIT License"></a>
  <a href="https://github.com/yossrinjeh/ShadBladeKit/stargazers"><img src="https://img.shields.io/github/stars/yossrinjeh/ShadBladeKit?style=for-the-badge&logo=github" alt="GitHub Stars"></a>
</p>

<p align="center">
  <a href="#demo">🎮 Live Demo</a> •
  <a href="#installation">⚡ Quick Start</a> •
  <a href="#features">✨ Features</a> •
  <a href="#documentation">📖 Documentation</a>
</p>

---

## 🎯 Overview

**ShadBladeKit** is a production-ready Laravel 11 starter template that combines enterprise-grade security, modern UI/UX, and powerful developer productivity tools.  
Skip months of boilerplate setup and start building your next amazing application today.

**Perfect for:**
- 🏢 Enterprise applications requiring robust authentication  
- 🚀 SaaS platforms needing multi-tenancy features  
- 🌍 International applications with multilingual support  
- 👥 Admin panels with advanced user management  
- 🎨 Applications requiring extensive theming capabilities  

---

## ✨ Features

### 🔐 Authentication & Security
- Full authentication system (login, register, reset, verify)
- Two‑factor authentication (TOTP)
- Recovery codes
- Role & permission system with Spatie
- Activity logging
- Session management

### 🎨 Modern UI/UX
- 5 theme presets
- Custom 8-color palette system
- Dark/light mode
- Responsive Tailwind UI
- Shadcn-style Blade components
- Command Palette (Ctrl+K)

### ⚡ CRUD Generator
- `php artisan create:crud Model`
- Generates migration, controller, views, permissions, sidebar, translations
- Modal-based CRUD
- Bulk actions
- Real-time search & pagination

### 🌍 Internationalization
- English, French, Spanish, Arabic
- RTL support
- Language switcher

### 📊 Analytics Dashboard
- Real‑time metrics
- Activity timeline
- Role distribution charts
- Custom KPI blocks

### 👤 User Management
- Full CRUD
- Bulk operations
- Search & filtering
- Profiles, avatars, preferences
- Export/import tools

---

## 🛠️ Technology Stack

**Backend**
- Laravel 11
- PHP 8.3+
- MySQL / PostgreSQL
- Redis (optional)

**Frontend**
- Blade
- Tailwind CSS
- Alpine.js
- Vite

**Packages**
- Spatie Permissions
- Laravel Breeze
- Chart.js
- Heroicons

---

## 🚀 Installation

### Requirements
- PHP 8.3+
- Composer
- Node.js 18+
- MySQL/PostgreSQL/SQLite

### Quick Start

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

### Default Credentials

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@example.com | password |
| User  | user@example.com  | password |

---

## ⚡ CRUD Generator

Generate CRUD instantly:

```bash
php artisan create:crud Post
php artisan create:crud Product
php artisan create:crud Category
```

### Generates:
- Migration  
- Model  
- Controller  
- Views  
- Form Request  
- Routes  
- Permissions  
- Sidebar Navigation  
- Translation files  

---

## 📁 Project Structure

```
ShadBladeKit/
├── app/
├── resources/
│   ├── views/
│   ├── lang/
│   └── js/
├── database/
│   ├── migrations/
│   └── seeders/
└── routes/
```

---

## 🗺️ Roadmap

### v1.0
- Authentication
- CRUD generator
- Themes
- Multilingual
- Dashboard

### v1.1
- API + Sanctum
- File Manager
- Email Templates
- Backups
- Queue Monitor

### v1.2
- Multi‑tenancy
- Payments
- Notification Center
- Analytics 2.0
- Plugin System

---

## 🤝 Contributing

1. Fork repo  
2. Create branch  
3. Commit  
4. Push  
5. PR  

---

## 📄 License

MIT License.

---

## 👨‍💻 Author
**Yossri Njeh**

GitHub: https://github.com/yossrinjeh

---

## ⭐ Support

If you like this kit, star the repo!

<p align="center">
  <a href="https://github.com/yossrinjeh/ShadBladeKit/stargazers">
    ⭐ Star on GitHub
  </a>
</p>

<p align="center">
  Built with ❤️ for Laravel
</p>
