<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

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
    
    // Roles & Permissions Management Routes (Admin Only)
    Route::middleware(['auth'])->group(function () {
        Route::resource('roles', App\Http\Controllers\RoleController::class)->except(['show', 'create', 'edit']);
        Route::post('/permissions', [App\Http\Controllers\RoleController::class, 'createPermission'])->name('permissions.store');
        Route::delete('/permissions/{permission}', [App\Http\Controllers\RoleController::class, 'deletePermission'])->name('permissions.destroy');
    });
});

require __DIR__.'/auth.php';
