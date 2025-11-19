# Laravel Modern Starter Kit — Full Build Instructions (Multilanguage Ready)
**For AI Coding Agents — Step-by-step Implementation Guide**

## 🚀 1. Project Setup

### 1.1 Create a New Laravel Project
```bash
composer create-project laravel/laravel laravel-modern-starter
cd laravel-modern-starter
```

### 1.2 Install Laravel Breeze (Blade Version)
```bash
composer require laravel/breeze --dev
php artisan breeze:install blade
npm install
npm run build
```

## 🎨 2. UI System Setup (Tailwind + Shadcn for Blade)

### 2.1 Install Shadcn for Laravel
```bash
composer require laravel-shadcn/shadcn
php artisan shadcn:install
```

### 2.2 Add Required Shadcn Components
```bash
php artisan shadcn:add button card dropdown input textarea table dialog alert toast avatar breadcrumb badge
```

### 2.3 Create ui/ Blade Component Structure
```
resources/views/components/ui/
   button.blade.php
   card.blade.php
   dropdown.blade.php
   modal.blade.php
   table.blade.php
   input.blade.php
   alert.blade.php
   toast.blade.php
   navbar.blade.php
   sidebar.blade.php
   theme-toggle.blade.php
   lang-switcher.blade.php
```

## 🌓 3. Dark Mode Setup

### 3.1 Configure Tailwind for Dark Mode
Edit `tailwind.config.js`:
```javascript
module.exports = {
  darkMode: 'class',
}
```

### 3.2 Add Dark Mode Toggle Component
**File:** `resources/views/components/ui/theme-toggle.blade.php`
- Toggles `class="dark"` on `<html>`
- Persists user choice via localStorage

## 🌍 4. Multilanguage System (en, fr, es, ar)

### 4.1 Publish Language Files
```bash
php artisan lang:publish
```

### 4.2 Add Languages in /lang
```
lang/en/*
lang/fr/*
lang/es/*
lang/ar/*
```

### 4.3 Create Locale Switcher Component
`resources/views/components/ui/lang-switcher.blade.php`
- Displays dropdown with languages

**Routes:**
```php
Route::get('locale/{locale}', function ($locale) {
    session()->put('locale', $locale);
    return back();
});
```

### 4.4 Middleware to Set Locale
`app/Http/Middleware/SetLocale.php`:
```php
public function handle($request, Closure $next)
{
    app()->setLocale(session('locale', 'en'));
    return $next($request);
}
```
Register in `Kernel.php` under `$middlewareGroups['web']`

## 🔐 5. Authentication Setup
- Login / Register / Forgot Password / Reset Password / Email Verification
- Customize all auth views with Shadcn components
- **Files:** `resources/views/auth/*`

## 📊 6. Dashboard Layout System
- **Layout:** `resources/views/layouts/app.blade.php`
- Includes sidebar, navbar, page container, theme toggle, language switcher, notifications
- **Dashboard page:** `resources/views/dashboard/index.blade.php`

**Components:**
- `<x-ui.navbar />`
- `<x-ui.sidebar />`
- `<x-ui.card />`
- `<x-ui.table />`

## 👤 7. User Profile Module
**Folder:** `resources/views/profile/`

**Files:**
- `edit.blade.php`
- `password.blade.php`
- `security.blade.php`

**Features:**
- Update name/email
- Upload avatar
- Change password
- Enable 2FA (optional)
- Multi-language labels

**Controller:** `ProfileController.php`

## 👮 8. Roles & Permissions (Spatie)

### Install Package
```bash
composer require spatie/laravel-permission
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
php artisan migrate
```

### Create Roles
```php
Role::create(['name' => 'admin']);
Role::create(['name' => 'user']);
```

### Protect Routes
```php
Route::middleware(['role:admin'])->group(function () {
    Route::get('/users', [UserController::class, 'index']);
});
```

## ⚙️ 9. Settings Page
**Folder:** `resources/views/settings/index.blade.php`

**Features:**
- Theme preference
- Language preference
- Notification preference
- Timezone
- Optional: API tokens

**Controller:** `SettingsController.php`

## 🔔 10. Notifications System
- Use Shadcn Toasts: `php artisan shadcn:add toast`
- Database notifications via Laravel Notification
- Display notifications in navbar or toast component

## 📝 11. Example Pages
- Dashboard: `resources/views/dashboard/index.blade.php`
- Users management page
- Profile page
- Settings page
- Optional: Activity logs

## 💡 12. Optional / WOW Features
- Matrix-style authentication animation
- Command palette search
- Pre-built background job examples
- Modern 404/500 pages
- Team management (optional)

## 📚 13. Documentation & Deliverables
- Screenshots (login, dashboard, components, settings)
- Short demo video (25–40 sec)
- **README:**
  - Project description
  - Features list
  - Installation instructions
  - Screenshots / demo link
  - Credits / contributions

## 🔗 14. Project Folder Structure
```
app/
 ├── Http/
 ├── Models/
 ├── Services/
resources/
 ├── views/
 │   ├── layouts/
 │   ├── components/
 │   ├── dashboard/
 │   ├── auth/
 │   ├── profile/
 │   └── settings/
public/
routes/
 ├── web.php
 └── api.php
lang/
 ├── en/
 ├── fr/
 ├── es/
 └── ar/
```

## ✅ 15. Execution Priority
1. Install Laravel + Breeze
2. Add Shadcn UI
3. Build Dashboard Layout
4. Add Dark Mode
5. Build Reusable Components
6. Create User Profile
7. Integrate Spatie Roles
8. Add Settings Page
9. Add Notifications
10. Build Example Pages
11. Add Optional WOW Features
12. Clean Code + Documentation
13. Publish on GitHub