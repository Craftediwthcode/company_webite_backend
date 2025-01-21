<?php

use Illuminate\Support\Facades\{Route, Artisan, Session};

Route::get('/', function () {
    return view('welcome');
});
Route::get('/clearapp', function () {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Session::flush();
    return redirect('/');
});
require __DIR__ . '/admin.php';
require __DIR__ . '/user.php';

