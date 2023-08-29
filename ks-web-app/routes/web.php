<?php

use App\Models\Artist;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectTypeController;
use App\Http\Controllers\RequestFormController;
use App\Http\Controllers\SignUpController;
use App\Models\ProjectType;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/projects', [ProjectController::class, 'index'])->name('projects');

Route::get('/projects/{project:id}', [ProjectController::class, 'show']);

Route::get('/request-list', [ProjectController::class, 'request_list'])->name('request-list');

Route::get('/request-form', [RequestFormController::class, 'index'])->name('request-form');

Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');;

Route::get('/gallery/categories', [GalleryController::class, 'all_categories'])->name('categories');

Route::get('/gallery/artists', [ArtistController::class, 'index'])->name('artists');

Route::get('gallery/artists/{artist:codename}', function (Artist $artist) {
    return view('artist', [
        'title' => $artist->artist_name . " Gallery",
        'active' => 'gallery',
        'artists' => $artist->projects->load('category', 'artist', 'type')
    ]);
});

Route::get('/gallery/videos/{project:id}', [GalleryController::class, 'show']);

Route::get('/projects-type/{projectType:slug}', [ProjectTypeController::class, 'show']);

Route::get('/gallery/videos/', function () {
    return redirect()->route('gallery');
});

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');

Route::post('/login', [LoginController::class, 'authenticate'])->name('login-post');

Route::get('/sign-up', [SignUpController::class, 'index'])->name('sign-up')->middleware('guest');;

Route::post('/sign-up', [SignUpController::class, 'store'])->name('sign-up-post');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Kasih Impor Excel,
// https://www.malasngoding.com/import-excel-laravel/

// Route::get('/dashboard/posts/checkSlug', [DashboardPostController::class, 'checkSlug'])->middleware('auth');
// Route::resource('/dashboard/posts', DashboardPostController::class)->middleware('auth');

// pakai gate
// Route::resource('/dashboard/categories', AdminCategoryController::class)->except('show');

// middle ware
// Route::resource('/dashboard/categories', AdminCategoryController::class)->except('show')->middleware('admin');
