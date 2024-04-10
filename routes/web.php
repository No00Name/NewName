<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

route::get('/home', [HomeController::class, 'index'])->name('home');
route::get('/one', [HomeController::class, 'one'])->name('cat.one');
route::get('/two', [HomeController::class, 'two'])->name('cat.two');
route::get('/three', [HomeController::class, 'three'])->name('cat.three');
route::get('/four', [HomeController::class, 'four'])->name('cat.four');
route::get('/five', [HomeController::class, 'five'])->name('cat.five');


route::get('/search', [HomeController::class, 'search'])->name('search');


route::get('/register', [UserController::class, 'create'])->name('user.create');
route::post('/register', [UserController::class, 'store'])->name('user.store');






route::middleware(['guest'])->group(function(){
    route::get('/login', [UserController::class, 'LoginCreate'])->name('login.create');
    route::post('/login', [UserController::class, 'LoginStore'])->name('login.store');
});

route::middleware(['auth'])->group(function(){
    route::get('/logout', [UserController::class, 'logout'])->name('logout');
    route::get('/post/create', [PostController::class, 'create'])->name('post.create');
    route::post('/post', [PostController::class, 'store'])->name('post.store');
});
route::middleware(['admin'])->group(function(){
    route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    route::get('/admin/create/{id}', [AdminController::class, 'create'])->name('admin.create');
    route::post('/admin/create/{id}', [AdminController::class, 'store'])->name('admin.store');
    route::get('/press', [HomeController::class, 'press'])->name('press');

    // route::get('/admin/post/create', [PostController::class, 'update'])->name('post.create');
    // route::post('admin/post', [PostController::class, 'stores'])->name('post.store');

    route::post('/admin/ban/{id}', [AdminController::class, 'ban'])->name('admin.ban');
    route::GET('/admin/press', [HomeController::class, 'press_admin'])->name('admin.press');
});
