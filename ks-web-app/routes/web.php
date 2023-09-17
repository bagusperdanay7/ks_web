<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\SignUpController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardAIModelController;
use App\Http\Controllers\DashboardAlbumController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectTypeController;
use App\Http\Controllers\RequestFormController;
use App\Http\Controllers\DashboardArtistController;
use App\Http\Controllers\DashboardCategoryController;
use App\Http\Controllers\DashboardProjectController;
use App\Http\Controllers\DashboardProjectTypeController;
use App\Http\Controllers\DashboardSongController;

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

Route::get('/form-request', [ProjectController::class, 'create'])->name('request-form');

Route::post('/form-request', [ProjectController::class, 'store'])->name('request-form-post');

Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');;

Route::get('/gallery/categories', [CategoryController::class, 'index'])->name('categories');

Route::get('/gallery/artists', [ArtistController::class, 'index'])->name('artists');

Route::get('gallery/artists/{artist:codename}', [ArtistController::class, 'show']);

Route::get('/gallery/videos/{project:id}', [GalleryController::class, 'show']);

Route::get('/projects-type/{projectType:slug}', [ProjectTypeController::class, 'show']);

Route::get('/gallery/videos/', function () {
    return redirect()->route('gallery');
});

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');

Route::post('/login', [LoginController::class, 'authenticate'])->name('login-post');

Route::get('/sign-up', [SignUpController::class, 'index'])->name('sign-up')->middleware('guest');;

Route::post('/sign-up', [SignUpController::class, 'store'])->name('sign-up-post');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// TODO: User Can Edit Profile, Update Password, And Have a Single Page = My Request

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('admin');

Route::resource('/dashboard/albums', DashboardAlbumController::class)->middleware('admin');

Route::resource('/dashboard/ai-models', DashboardAIModelController::class)->middleware('admin');

Route::resource('/dashboard/artists', DashboardArtistController::class)->middleware('admin');

Route::resource('/dashboard/categories', DashboardCategoryController::class)->middleware('admin');

Route::resource('/dashboard/projects', DashboardProjectController::class)->middleware('auth');

Route::resource('/dashboard/project-types', DashboardProjectTypeController::class)->middleware('admin');

Route::resource('/dashboard/songs', DashboardSongController::class)->middleware('admin');