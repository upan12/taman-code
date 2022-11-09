<?php

use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('homepage.index');
});

Route::get('/admin', [DashboardController::class, 'index']);
Route::get('/login', function () {
    return view('homepage.login');
});

Route::get('/forgot', function () {
    return view('homepage.forgot');
});

Route::get('/register', function () {
    return view('homepage.register');
});

Route::get('/about', function () {
    return view('homepage.about');
});

Route::get('/allCreation', function () {
    return view('homepage.allCreation');
});

Route::get('/myCreation', function () {
    return view('homepage.myCreation');
});

Route::get('/addCreation', function () {
    return view('homepage.addCreation');
});

Route::get('/contact', function () {
    return view('homepage.contact');
});

Route::get('/admin', function () {
    return view('dashboard.index');
});

Route::resource('/admin/user', DashboardUserController::class);
