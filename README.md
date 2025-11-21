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

**ShadBladeKit** is a production-ready Laravel 11 starter template that combines enterprise-grade security, modern UI/UX, and developer productivity tools. Skip months of boilerplate setup and start building your next amazing application today.

**Perfect for:**
- 🏢 Enterprise applications requiring robust authentication
- 🚀 SaaS platforms needing multi-tenancy features
- 🌍 International applications with multilingual support
- 👥 Admin panels with advanced user management
- 🎨 Applications requiring extensive theming capabilities

---

## ✨ Features

### 🔐 Authentication & Security
- **Complete Auth System** - Login, register, password reset, email verification
- **Two-Factor Authentication** - TOTP with Google Authenticator support
- **Recovery Codes** - Secure backup authentication method
- **Role-Based Access Control** - Granular permissions with Spatie
- **Activity Logging** - Comprehensive audit trail for all user actions
- **Session Management** - Advanced session handling and security

### 🎨 Modern UI/UX
- **5 Theme Presets** - Classic Blue, Emerald SaaS, Cyber Purple, Warm Orange, Minimal B/W
- **Custom Color System** - 8-color palette with live preview
- **Dark/Light Mode** - Persistent theme switching
- **Responsive Design** - Mobile-first approach with Tailwind CSS
- **Shadcn-Inspired Components** - Beautiful, accessible UI components
- **Command Palette** - Quick navigation with `Ctrl+K`

### ⚡ CRUD Generator
- **One-Command Generation** - `php artisan create:crud ModelName`
- **Complete Setup** - Migration, model, controller, views, routes, permissions
- **Modal Interface** - Modern modal-based CRUD operations
- **Bulk Operations** - Multi-select and bulk actions
- **Auto-Integration** - Sidebar navigation and permissions automatically added

### 🌍 Internationalization
- **4 Languages** - English, French, Spanish, Arabic
- **RTL Support** - Right-to-left layout for Arabic
- **Organized Structure** - Modular translation files
- **Easy Switching** - Language switcher component

### 📊 Analytics Dashboard
- **Real-time Metrics** - User statistics, registration trends
- **Activity Timeline** - Recent user activities and system events
- **Role Distribution** - Visual representation of user roles
- **Custom KPIs** - Extensible analytics system

### 👤 Advanced User Management
- **Complete CRUD** - Create, edit, delete users with validation
- **Bulk Operations** - Mass operations for user management
- **Profile System** - Avatar upload, preferences, settings
- **Advanced Search** - Filter users by role, status, registration date
- **Export/Import** - User data management tools

---

## 🛠️ Technology Stack

<table>
<tr>
<td>

**Backend**
- Laravel 11
- PHP 8.3+
- MySQL/PostgreSQL
- Redis (optional)

</td>
<td>

**Frontend**
- Blade Templates
- Tailwind CSS
- Alpine.js
- Vite

</td>
<td>

**Packages**
- Spatie Permissions
- Laravel Breeze
- Chart.js
- Heroicons

</td>
</tr>
</table>

---

## 📸 Screenshots

<table>
<tr>
<td width="50%">

### 📊 Analytics Dashboard
![Dashboard](https://via.placeholder.com/600x400/1f2937/ffffff?text=Analytics+Dashboard)
*Real-time metrics and user insights*

</td>
<td width="50%">

### 👥 User Management
![User Management](https://via.placeholder.com/600x400/1f2937/ffffff?text=User+Management)
*Advanced CRUD with bulk operations*

</td>
</tr>
<tr>
<td width="50%">

### 🎨 Theme Selector
![Theme Selector](https://via.placeholder.com/600x400/1f2937/ffffff?text=Theme+Selector)
*5 presets + custom color system*

</td>
<td width="50%">

### ⚡ Command Palette
![Command Palette](https://via.placeholder.com/600x400/1f2937/ffffff?text=Command+Palette)
*Quick navigation with Ctrl+K*

</td>
</tr>
</table>

---

## 🚀 Installation

### Prerequisites
- PHP 8.3+
- Composer
- Node.js 18+ & NPM
- MySQL/PostgreSQL/SQLite

### Quick Start

```bash
# 1. Clone the repository
git clone https://github.com/yossrinjeh/ShadBladeKit.git
cd ShadBladeKit

# 2. Install dependencies
composer install
npm install

# 3. Environment setup
cp .env.example .env
php artisan key:generate

# 4. Configure database in .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=shadbladekit
DB_USERNAME=your_username
DB_PASSWORD=your_password

# 5. Run migrations and seeders
php artisan migrate --seed

# 6. Build assets
npm run build

# 7. Start development server
php artisan serve
```

### 🔑 Default Credentials

| Role | Email | Password |
|------|-------|----------|
| **Admin** | admin@example.com | password |
| **User** | user@example.com | password |

---

## ⚡ CRUD Generator

Generate complete CRUD interfaces in seconds:

```bash
# Generate a Posts CRUD
php artisan create:crud Post

# Generate a Products CRUD
php artisan create:crud Product

# Generate a Categories CRUD
php artisan create:crud Category
```

### What Gets Generated

✅ **Migration** - Database table with basic fields  
✅ **Model** - Eloquent model with activity logging  
✅ **Controller** - Full CRUD operations + bulk actions  
✅ **Views** - Modal-based interface matching your design  
✅ **Request** - Form validation rules  
✅ **Routes** - Protected with permissions  
✅ **Permissions** - Auto-created and assigned to admin  
✅ **Sidebar** - Navigation link with icon  
✅ **Translations** - Multi-language support  

### Generated Features

- 🔍 **Real-time Search** - Instant search functionality
- 📄 **Smart Pagination** - Efficient data handling
- ✏️ **Modal CRUD** - Create/Edit/Delete in modals
- 🗑️ **Bulk Operations** - Multi-select operations
- 🔐 **Permission Protected** - Role-based access control
- 📱 **Mobile Responsive** - Works on all devices
- 🎨 **Design Consistency** - Matches your UI components

---

## 📁 Project Structure

```
ShadBladeKit/
├── app/
│   ├── Console/Commands/     # Custom Artisan commands
│   ├── Http/Controllers/     # Application controllers
│   ├── Models/              # Eloquent models
│   └── Providers/           # Service providers
├── resources/
│   ├── views/
│   │   ├── components/ui/   # Reusable UI components
│   │   ├── auth/           # Authentication views
│   │   ├── dashboard/      # Dashboard views
│   │   └── users/          # User management
│   ├── lang/               # Multi-language files
│   │   ├── en/             # English
│   │   ├── fr/             # French
│   │   ├── es/             # Spanish
│   │   └── ar/             # Arabic (RTL)
│   └── js/                 # Frontend assets
├── database/
│   ├── migrations/         # Database migrations
│   └── seeders/           # Database seeders
└── routes/
    ├── web.php            # Web routes
    └── auth.php           # Authentication routes
```

---

## 🗺️ Roadmap

### 🎯 v1.0 (Current)
- ✅ Complete authentication system
- ✅ CRUD generator
- ✅ Theme system
- ✅ Multi-language support
- ✅ User management
- ✅ Analytics dashboard

### 🚀 v1.1 (Next Release)
- 🔄 **API Support** - RESTful API with Sanctum
- 🔄 **File Manager** - Advanced file upload system
- 🔄 **Email Templates** - Customizable email templates
- 🔄 **Backup System** - Automated database backups
- 🔄 **Queue Management** - Job queue monitoring

### 🌟 v1.2 (Future)
- 🔄 **Multi-tenancy** - SaaS-ready multi-tenant architecture
- 🔄 **Payment Integration** - Stripe/PayPal integration
- 🔄 **Notification Center** - Real-time notifications
- 🔄 **Advanced Analytics** - Custom reporting system
- 🔄 **Plugin System** - Extensible plugin architecture

---

## 🤝 Contributing

We welcome contributions from the community! Here's how you can help:

### Getting Started
1. Fork the repository
2. Create a feature branch: `git checkout -b feature/amazing-feature`
3. Make your changes
4. Run tests: `php artisan test`
5. Commit changes: `git commit -m 'Add amazing feature'`
6. Push to branch: `git push origin feature/amazing-feature`
7. Open a Pull Request

### Development Guidelines
- Follow PSR-12 coding standards
- Write tests for new features
- Update documentation
- Use conventional commit messages
- Ensure backward compatibility

---

## 📄 License

This project is open-sourced software licensed under the [MIT license](LICENSE).

---

## 👨‍💻 Author

**Yossri Njeh**
- GitHub: [@yossrinjeh](https://github.com/yossrinjeh)
- Email: yossri.njeh@example.com

---

## 🌟 Show Your Support

If ShadBladeKit helped you build something amazing, please consider:

<p align="center">
  <a href="https://github.com/yossrinjeh/ShadBladeKit/stargazers">
    <img src="https://img.shields.io/github/stars/yossrinjeh/ShadBladeKit?style=social" alt="Star on GitHub">
  </a>
</p>

**⭐ Star this repository if you found it helpful!**

---

<p align="center">
  <strong>Built with ❤️ for the Laravel community</strong>
</p>

<p align="center">
  <a href="#top">⬆️ Back to Top</a>
</p>