# 🚀 Laravel Modern Starter Kit

<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
</p>

<p align="center">
  <a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## 🎯 **Overview**

A **production-ready Laravel 11 starter template** with enterprise-grade features, modern UI components, and comprehensive security. Built for developers who want to skip the boilerplate and start building amazing applications immediately.

### ✨ **What Makes This Special**

- 🔐 **Enterprise Security** - 2FA, role-based permissions, activity logging
- 🌍 **Multilingual Ready** - 4 languages with RTL support
- 🎨 **Modern UI/UX** - Dark mode, responsive design, Shadcn-inspired components
- 📊 **Analytics Dashboard** - Real-time metrics and user insights
- 🚀 **Production Ready** - Optimized, tested, and documented

---

## 🏗️ **Features**

### 🔐 **Authentication & Security**
- ✅ **Complete Auth System** - Login, Register, Password Reset, Email Verification
- ✅ **Two-Factor Authentication** - TOTP with Google Authenticator support
- ✅ **Recovery Codes** - Backup authentication method
- ✅ **Roles & Permissions** - Spatie package integration
- ✅ **Activity Logging** - Comprehensive audit trail
- ✅ **Role-Based Access Control** - Granular permission system

### 👤 **User Management**
- ✅ **Advanced User CRUD** - Create, edit, delete users
- ✅ **Bulk Operations** - Mass delete, role assignment
- ✅ **User Profiles** - Avatar upload, preferences
- ✅ **Search & Filters** - Advanced user filtering
- ✅ **Pagination** - Efficient data handling

### 🎨 **UI/UX Features**
- ✅ **Dark/Light Mode** - Persistent theme switching
- ✅ **Responsive Design** - Mobile-first approach
- ✅ **Custom Components** - Shadcn-inspired Blade components
- ✅ **Modern Sidebar** - Professional navigation
- ✅ **Toast Notifications** - Real-time feedback

### 🌍 **Internationalization**
- ✅ **4 Languages** - English, French, Spanish, Arabic
- ✅ **RTL Support** - Right-to-left layout for Arabic
- ✅ **Organized Translations** - Modular translation structure
- ✅ **Language Switcher** - Easy language switching

### 📊 **Analytics & Monitoring**
- ✅ **Dashboard Analytics** - KPI cards, charts, metrics
- ✅ **Activity Timeline** - Recent user activities
- ✅ **User Statistics** - Registration trends, role distribution
- ✅ **Real-time Data** - Live updates and insights

---

## 🛠️ **Tech Stack**

| Category | Technology |
|----------|------------|
| **Backend** | Laravel 11, PHP 8.2+ |
| **Frontend** | Blade, Tailwind CSS, Alpine.js |
| **Database** | MySQL/PostgreSQL/SQLite |
| **Authentication** | Laravel Breeze + Custom 2FA |
| **Permissions** | Spatie Laravel Permission |
| **UI Components** | Custom Blade Components |
| **Charts** | Chart.js |
| **Icons** | Heroicons |

---

## 🚀 **Quick Start**

### Prerequisites
- PHP 8.2+
- Composer
- Node.js & NPM
- MySQL/PostgreSQL/SQLite

### Installation

1. **Clone the repository**
```bash
git clone https://github.com/yossrinjeh/ShadBladeKit.git
cd ShadBladeKit
```

2. **Install dependencies**
```bash
composer install
npm install
```

3. **Environment setup**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Database configuration**
```bash
# Configure your database in .env file
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

5. **Run migrations and seeders**
```bash
php artisan migrate --seed
```

6. **Build assets**
```bash
npm run build
```

7. **Start the application**
```bash
php artisan serve
```

### 🔑 **Default Credentials**

| Role | Email | Password |
|------|-------|----------|
| **Admin** | admin@example.com | password |
| **User** | user@example.com | password |

---

## 📁 **Project Structure**

```
├── app/
│   ├── Http/Controllers/     # Business logic
│   ├── Models/              # Eloquent models
│   └── Listeners/           # Event listeners
├── resources/
│   ├── views/
│   │   ├── components/ui/   # Reusable UI components
│   │   ├── auth/           # Authentication views
│   │   ├── profile/        # Profile management
│   │   └── users/          # User management
│   └── lang/               # Multilingual files
│       ├── en/             # English translations
│       ├── fr/             # French translations
│       ├── es/             # Spanish translations
│       └── ar/             # Arabic translations
├── database/
│   ├── migrations/         # Database schema
│   └── seeders/           # Sample data
└── routes/
    ├── web.php            # Web routes
    └── auth.php           # Authentication routes
```

---

## 🔧 **Configuration**

### Two-Factor Authentication
```php
// Enable 2FA for a user
$user->enableTwoFactorAuthentication();

// Generate recovery codes
$user->generateRecoveryCodes();
```

### Roles & Permissions
```php
// Create roles
Role::create(['name' => 'admin']);
Role::create(['name' => 'user']);

// Assign permissions
$user->assignRole('admin');
$user->givePermissionTo('view users');
```

### Language Configuration
```php
// Set user language preference
$user->update(['language' => 'fr']);

// Use in views
{{ __('navigation.dashboard') }}
{{ __('common.save') }}
```

---

## 🎨 **UI Components**

### Available Components
- `<x-ui.button>` - Customizable buttons
- `<x-ui.card>` - Content containers
- `<x-ui.input>` - Form inputs
- `<x-ui.dropdown>` - Dropdown menus
- `<x-ui.toast>` - Notification toasts
- `<x-ui.theme-toggle>` - Dark mode toggle
- `<x-ui.lang-switcher>` - Language switcher

### Usage Example
```blade
<x-ui.card>
    <x-ui.button variant="primary" size="lg">
        Save Changes
    </x-ui.button>
</x-ui.card>
```

---

## 🔐 **Security Features**

### Two-Factor Authentication
- TOTP-based authentication
- QR code generation
- Recovery codes
- Google Authenticator compatible

### Activity Logging
- User actions tracking
- Authentication events
- IP address logging
- Admin audit trail

### Role-Based Access Control
- Granular permissions
- Route protection
- UI element visibility
- Data filtering by role

---

## 🌍 **Internationalization**

### Supported Languages
- 🇺🇸 **English** (en)
- 🇫🇷 **French** (fr)
- 🇪🇸 **Spanish** (es)
- 🇸🇦 **Arabic** (ar) - with RTL support

### Adding New Languages
1. Create language directory: `lang/de/`
2. Copy translation files from `lang/en/`
3. Translate content
4. Add to language switcher

---

## 📊 **Analytics Dashboard**

### Available Metrics
- Total users count
- Active users percentage
- New registrations
- Role distribution
- Activity timeline
- Registration trends

### Customization
```php
// Add custom metrics in AnalyticsController
private function getCustomMetrics()
{
    return [
        'custom_metric' => YourModel::count(),
        // Add more metrics
    ];
}
```

---

## 🚀 **Deployment**

### Production Checklist
- [ ] Set `APP_ENV=production`
- [ ] Configure database
- [ ] Set up SSL certificate
- [ ] Configure mail settings
- [ ] Run `php artisan optimize`
- [ ] Set up queue workers
- [ ] Configure backup system

### Environment Variables
```env
APP_NAME="Your App Name"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

# Database
DB_CONNECTION=mysql
DB_HOST=your-host
DB_DATABASE=your-database
DB_USERNAME=your-username
DB_PASSWORD=your-password

# Mail
MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
MAIL_PORT=587
MAIL_USERNAME=your-email
MAIL_PASSWORD=your-password
```

---

## 🤝 **Contributing**

We welcome contributions! Please follow these steps:

1. Fork the repository
2. Create a feature branch: `git checkout -b feature/amazing-feature`
3. Commit changes: `git commit -m 'Add amazing feature'`
4. Push to branch: `git push origin feature/amazing-feature`
5. Open a Pull Request

### Development Guidelines
- Follow PSR-12 coding standards
- Write tests for new features
- Update documentation
- Use conventional commit messages

---

## 📝 **License**

This project is licensed under the [MIT License](LICENSE).

---

## 🙏 **Acknowledgments**

- [Laravel](https://laravel.com) - The PHP framework
- [Tailwind CSS](https://tailwindcss.com) - Utility-first CSS framework
- [Spatie](https://spatie.be) - Laravel packages
- [Heroicons](https://heroicons.com) - Beautiful SVG icons
- [Chart.js](https://www.chartjs.org) - Simple yet flexible charting

---

## 📞 **Support**

- 📧 **Email**: support@yourapp.com
- 🐛 **Issues**: [GitHub Issues](https://github.com/yossrinjeh/ShadBladeKit/issues)
- 💬 **Discussions**: [GitHub Discussions](https://github.com/yossrinjeh/ShadBladeKit/discussions)
- 📖 **Documentation**: [Wiki](https://github.com/yossrinjeh/ShadBladeKit/wiki)

---

<p align="center">
  <strong>⭐ If you find this project helpful, please give it a star! ⭐</strong>
</p>

<p align="center">
  Made with ❤️ by <a href="https://github.com/yossrinjeh">Yossri Njeh</a>
</p>