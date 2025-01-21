<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/about-us', [HomeController::class, 'aboutUs'])->name('about-us');
Route::get('/portfolio', [HomeController::class, 'portfolio'])->name('portfolio');
Route::get('/contact-us', [HomeController::class, 'contactUs'])->name('contact-us');
Route::post('/submit-contact-us', [HomeController::class, 'submitContactUs'])->name('submit.contact-us');