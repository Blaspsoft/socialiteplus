<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialitePlusController;

Route::get('/auth/social/{provider}', [SocialitePlusController::class, 'redirect'])->name('social.redirect');
Route::get('/auth/social/{provider}/callback', [SocialitePlusController::class, 'callback'])->name('social.callback');