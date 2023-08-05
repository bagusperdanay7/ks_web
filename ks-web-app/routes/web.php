<?php

use App\Models\Artist;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;

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

Route::get('/projects/huge-project-vol1', [ProjectController::class, 'huge_project_vol1'])->name('huge-project-vol1');

Route::get('/projects/nostalgic-vibes', [ProjectController::class, 'nostalgic_vibes'])->name('nostalgic-vibes');

Route::get('/projects/youtube-comment', [ProjectController::class, 'youtube_comment'])->name('youtube-comment');

Route::get('/projects/non-project', [ProjectController::class, 'non_project'])->name('non-project');

Route::get('/request-list', [ProjectController::class, 'request_list'])->name('request-list');

Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');;

Route::get('/gallery/content-categories', [GalleryController::class, 'all_content_categories'])->name('categories');

Route::get('/gallery/artists', [ArtistController::class, 'index'])->name('artists')->name('artists');

Route::get('gallery/artists/{artist:codename}', function (Artist $artist) {
    return view('artist', [
        'title' => $artist->artist_name . " Gallery",
        'active' => 'gallery',
        'artists' => $artist->projects->load('content_category', 'artist')
    ]);
});

Route::get('/gallery/videos/{project:id}', [GalleryController::class, 'show']);

Route::get('/gallery/videos/', function () {
    return redirect()->route('gallery');
});

// Kasih Impor Excel
// https://www.malasngoding.com/import-excel-laravel/

// Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
// Route::post('/login', [LoginController::class, 'authenticate']);
// Route::post('/logout', [LoginController::class, 'logout']);

// Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
// Route::post('/register', [RegisterController::class, 'store']);

// Route::get('/dashboard', function () {
//     return view('dashboard.index');
// })->middleware('auth');

// Route::get('/dashboard/posts/checkSlug', [DashboardPostController::class, 'checkSlug'])->middleware('auth');
// Route::resource('/dashboard/posts', DashboardPostController::class)->middleware('auth');

// pakai gate
// Route::resource('/dashboard/categories', AdminCategoryController::class)->except('show');

// middle ware
// Route::resource('/dashboard/categories', AdminCategoryController::class)->except('show')->middleware('admin');
