<?php

use App\Http\Controllers\PublicController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

Route::get('/', fn () => view('public.home'))->name('home');
Route::get('/about', fn () => view('public.about'))->name('about');
Route::get('/advisors', fn () => view('public.advisors'))->name('advisors');
Route::get('/contact', fn () => view('public.contact'))->name('contact');
Route::get('/funds', fn () => view('public.funds'))->name('funds');
Route::get('/invest', fn () => view('public.invest'))->name('invest');
Route::get('/legal', fn () => view('public.legal'))->name('legal');
Route::get('/news', fn () => view('public.news'))->name('news');
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
