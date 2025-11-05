<?php

use App\Http\Controllers\PublicController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/about', [PublicController::class, 'about'])->name('about');
Route::get('/advisors', [PublicController::class, 'advisors'])->name('advisors');
Route::get('/contact', [PublicController::class, 'contact'])->name('contact');
Route::get('/funds', [PublicController::class, 'funds'])->name('funds');
Route::get('/invest', [PublicController::class, 'invest'])->name('invest');
Route::get('/legal', [PublicController::class, 'legal'])->name('legal');
Route::get('/news', [PublicController::class, 'news'])->name('news');
Route::get('/news/{link}', [PublicController::class, 'newsLink'])->name('news-link');
Route::get('/privacy-policy', [PublicController::class, 'privacy'])->name('privacy');
Route::get('/terms-conditions', [PublicController::class, 'terms'])->name('terms');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('profile.edit');
    Route::get('settings/password', Password::class)->name('user-password.edit');
    Route::get('settings/appearance', Appearance::class)->name('appearance.edit');

    Route::get('settings/two-factor', TwoFactor::class)
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});
