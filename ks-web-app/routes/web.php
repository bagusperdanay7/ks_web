<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Password;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\SignUpController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AIModelController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectTypeController;
use App\Http\Controllers\DashboardSongController;
use App\Http\Controllers\DashboardAlbumController;
use App\Http\Controllers\DashboardArtistController;
use App\Http\Controllers\DashboardAIModelController;
use App\Http\Controllers\DashboardProjectController;
use App\Http\Controllers\DashboardCategoryController;
use App\Http\Controllers\DashboardAlbumSongsController;
use App\Http\Controllers\DashboardProjectTypeController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\ResetPasswordController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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

Route::get('/about-us', [AboutUsController::class, 'index'])->name('about-us');

Route::get('/projects', [ProjectController::class, 'index'])->name('projects');

Route::get('/projects/{project:id}', [ProjectController::class, 'show']);

Route::get('/request-list', [ProjectController::class, 'request_list'])->name('request-list');

Route::get('/form-request', [ProjectController::class, 'create'])->middleware(['auth', 'verified'])->name('request-form');

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

Route::get('/ai-models', [AIModelController::class, 'index'])->name('ai-model');

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');

Route::post('/login', [LoginController::class, 'authenticate'])->name('login-post');

Route::get('/sign-up', [SignUpController::class, 'index'])->name('sign-up')->middleware('guest');

Route::post('/sign-up', [SignUpController::class, 'store'])->name('sign-up-post');

Route::get('/verification', [SignUpController::class, 'verification'])->name('verify-email')->middleware('guest');

Route::get('/email/verify', [EmailVerificationController::class, 'sentEmailVerification'])->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verificationSuccess'])->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationController::class, 'resendVerification'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/auth/google/redirect', [LoginController::class, 'googleLoginRedirect'])->name('google.login');

Route::get('/auth/google/callback/', [LoginController::class, 'googleLoginCallback'])->name('google.callback');

Route::get('/forgot-password', [ResetPasswordController::class, 'index'])->middleware('guest')->name('password.request');

Route::post('/forgot-password', [ResetPasswordController::class, 'sendEmail'])->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'resetPasswordView'])->middleware('guest')->name('password.reset');

Route::post('/reset-password', [ResetPasswordController::class, 'update'])->middleware('guest')->name('password.update');

Route::get('/account/profile', [AccountController::class, 'index'])->middleware('auth')->name('profile');

Route::get('/account/requests', [AccountController::class, 'index'])->middleware('auth')->name('my-request');

Route::put('/account/profile', [AccountController::class, 'update'])->name('account.update');

Route::put('/account/picture', [AccountController::class, 'updateProfilePicture'])->name('account.profile.update');

Route::delete('/account/picture', [AccountController::class, 'removeProfilePicture'])->name('account.profile.remove');

Route::put('/account/password', [AccountController::class, 'changePassword'])->name('password.change');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('admin');

Route::resource('/dashboard/albums', DashboardAlbumController::class)->middleware('admin');

Route::resource('/dashboard/album-songs', DashboardAlbumSongsController::class)->middleware('admin');

Route::resource('/dashboard/ai-models', DashboardAIModelController::class)->middleware('admin');

Route::resource('/dashboard/artists', DashboardArtistController::class)->middleware('admin');

Route::resource('/dashboard/categories', DashboardCategoryController::class)->middleware('admin');

Route::resource('/dashboard/projects', DashboardProjectController::class)->middleware('auth');

Route::resource('/dashboard/project-types', DashboardProjectTypeController::class)->middleware('admin');

Route::resource('/dashboard/songs', DashboardSongController::class)->middleware('admin');

