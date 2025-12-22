<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CampaignAdminController;
use App\Http\Controllers\Admin\DonationAdminController;
use App\Http\Controllers\Admin\DonorAdminController;

Route::prefix('admin')->group(function () {
    // Redirect /admin/ to dashboard or login
    Route::get('/', function () {
        if (auth()->check() && auth()->user()->is_admin) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('admin.login');
    })->name('admin.home');

    // Admin Auth Routes (tanpa middleware)
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login')->middleware('guest');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.post')->middleware('guest');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    // Admin Dashboard & Management Routes (dengan admin middleware)
    Route::middleware(['auth', 'admin'])->group(function () {
        // Dashboard
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        // Campaign Management
        Route::resource('campaigns', CampaignAdminController::class, ['as' => 'admin']);

        // Donation Management
        Route::get('/donations', [DonationAdminController::class, 'index'])->name('admin.donations.index');
        Route::get('/donations/{donation}', [DonationAdminController::class, 'show'])->name('admin.donations.show');
        Route::post('/donations/{donation}/update-status', [DonationAdminController::class, 'updateStatus'])->name('admin.donations.update-status');
        Route::get('/donations/export', [DonationAdminController::class, 'export'])->name('admin.donations.export');

        // Donor Management
        Route::get('/donors', [DonorAdminController::class, 'index'])->name('admin.donors.index');
        Route::get('/donors/{email}', [DonorAdminController::class, 'show'])->name('admin.donors.show');
        Route::get('/donors/export', [DonorAdminController::class, 'export'])->name('admin.donors.export');

        
    });
});
