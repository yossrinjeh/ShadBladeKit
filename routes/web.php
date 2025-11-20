<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return auth()->check() ? redirect()->route('dashboard') : view('welcome');
})->name('welcome');

Route::get('locale/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'fr', 'es', 'ar'])) {
        session()->put('locale', $locale);
    }
    return back();
})->name('locale.switch');

Route::get('/dashboard', [App\Http\Controllers\AnalyticsController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar');
    Route::patch('/profile/language', [ProfileController::class, 'updateLanguage'])->name('profile.language');
    Route::post('/profile/dark-mode', [ProfileController::class, 'toggleDarkMode'])->name('profile.dark-mode');
    Route::patch('/profile/notifications', [ProfileController::class, 'updateNotifications'])->name('profile.notifications');
    
    // Two-Factor Authentication Routes
    Route::post('/two-factor/enable', [App\Http\Controllers\TwoFactorController::class, 'enable'])->name('two-factor.enable');
    Route::post('/two-factor/confirm', [App\Http\Controllers\TwoFactorController::class, 'confirm'])->name('two-factor.confirm');
    Route::post('/two-factor/disable', [App\Http\Controllers\TwoFactorController::class, 'disable'])->name('two-factor.disable');
    Route::post('/two-factor/recovery-codes', [App\Http\Controllers\TwoFactorController::class, 'regenerateRecoveryCodes'])->name('two-factor.recovery-codes');
    
    Route::get('/settings', [App\Http\Controllers\SettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings', [App\Http\Controllers\SettingsController::class, 'update'])->name('settings.update');
    
    Route::post('/notifications/test', [App\Http\Controllers\NotificationController::class, 'test'])->name('notifications.test');
    Route::post('/notifications/{id}/read', [App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [App\Http\Controllers\NotificationController::class, 'markAllAsRead'])->name('notifications.read-all');
    
    // Analytics Routes
    Route::get('/analytics/api', [App\Http\Controllers\AnalyticsController::class, 'api'])->name('analytics.api');
    
    // Components Showcase Routes
    Route::get('/components', [App\Http\Controllers\ComponentsController::class, 'index'])->name('components.index');
    Route::post('/components/file-upload', [App\Http\Controllers\ComponentsController::class, 'fileUpload'])->name('components.file-upload');
    Route::post('/components/rich-content', [App\Http\Controllers\ComponentsController::class, 'richContent'])->name('components.rich-content');
    
    // User Management Routes
    Route::middleware(['can:view users'])->group(function () {
        Route::resource('users', App\Http\Controllers\UserController::class);
        Route::post('/users/bulk-delete', [App\Http\Controllers\UserController::class, 'bulkDelete'])->name('users.bulk-delete')->middleware('can:delete users');
    });
    
    // Post Management Routes
    Route::middleware(['can:view posts'])->group(function () {
        Route::resource('posts', App\Http\Controllers\PostController::class);
        Route::post('/posts/bulk-delete', [App\Http\Controllers\PostController::class, 'bulkDelete'])->name('posts.bulk-delete')->middleware('can:delete posts');
    });
    
    // Roles & Permissions Management Routes (Admin Only)
    Route::middleware(['auth'])->group(function () {
        Route::resource('roles', App\Http\Controllers\RoleController::class)->except(['show', 'create', 'edit']);
        Route::post('/permissions', [App\Http\Controllers\RoleController::class, 'createPermission'])->name('permissions.store');
        Route::delete('/permissions/{permission}', [App\Http\Controllers\RoleController::class, 'deletePermission'])->name('permissions.destroy');
    });
    
    // Activity Logs (Admin Only)
    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/activity-logs', [App\Http\Controllers\ActivityLogController::class, 'index'])->name('activity-logs.index');
        Route::get('/admin/settings', [App\Http\Controllers\AdminSettingsController::class, 'index'])->name('admin.settings');
        Route::patch('/admin/settings', [App\Http\Controllers\AdminSettingsController::class, 'update'])->name('admin.settings.update');
    });
    
    // Category Management Routes
    Route::middleware(['can:view categories'])->group(function () {
        Route::resource('categories', App\Http\Controllers\CategoryController::class);
        Route::post('/categories/bulk-delete', [App\Http\Controllers\CategoryController::class, 'bulkDelete'])->name('categories.bulk-delete')->middleware('can:delete categories');
    });

    // Order Management Routes
    Route::middleware(['can:view orders'])->group(function () {
        Route::resource('orders', App\Http\Controllers\OrderController::class);
        Route::post('/orders/bulk-delete', [App\Http\Controllers\OrderController::class, 'bulkDelete'])->name('orders.bulk-delete')->middleware('can:delete orders');
    });

    // Brand Management Routes
    Route::middleware(['can:view brands'])->group(function () {
        Route::resource('brands', App\Http\Controllers\BrandController::class);
        Route::post('/brands/bulk-delete', [App\Http\Controllers\BrandController::class, 'bulkDelete'])->name('brands.bulk-delete')->middleware('can:delete brands');
    });

    // Customer Management Routes
    Route::middleware(['can:view customers'])->group(function () {
        Route::resource('customers', App\Http\Controllers\CustomerController::class);
        Route::post('/customers/bulk-delete', [App\Http\Controllers\CustomerController::class, 'bulkDelete'])->name('customers.bulk-delete')->middleware('can:delete customers');
    });
});

require __DIR__.'/auth.php';
