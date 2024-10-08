<?php

use App\Http\Controllers\DashboardPlaylistProjectController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\SignUpController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AIModelController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TutorialController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\ProjectTypeController;
use App\Http\Controllers\RequestListController;
use App\Http\Controllers\DashboardSongController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\DashboardAlbumController;
use App\Http\Controllers\DashboardArtistController;
use App\Http\Controllers\DashboardAIModelController;
use App\Http\Controllers\DashboardAlbumArtistController;
use App\Http\Controllers\DashboardProjectController;
use App\Http\Controllers\DashboardCategoryController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\DashboardCompanyController;
use App\Http\Controllers\DashboardGenreController;
use App\Http\Controllers\DashboardIdolController;
use App\Http\Controllers\DashboardMemberGroupController;
use App\Http\Controllers\DashboardPlaylistController;
use App\Http\Controllers\DashboardProjectArtistController;
use App\Http\Controllers\DashboardProjectTypeController;
use App\Http\Controllers\DashboardSongArtistController;
use App\Http\Controllers\DashboardSongGenreController;

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

Route::get('/projects/{project:id}', [ProjectController::class, 'show'])->name('show-project');

Route::put('/projects/{project:id}', [ProjectController::class, 'upvote'])->middleware(['auth', 'throttle:upvote'])->name('upvote-project');

Route::get('/projects-type/{projectType:slug}', [ProjectTypeController::class, 'index'])->name('types');

Route::get('/request-list', [RequestListController::class, 'index'])->name('request-list');

Route::get('/request-list/form', [RequestListController::class, 'create'])->middleware(['auth', 'verified'])->name('request-form');

Route::post('/request-list/form', [RequestListController::class, 'store'])->name('request-form-post');

Route::prefix('gallery')->group(function () {
    Route::get('/', [GalleryController::class, 'index'])->name('gallery');

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');

    Route::get('/artists', [ArtistController::class, 'index'])->name('artists');

    Route::get('/artists/{artist:codename}', [ArtistController::class, 'show'])->name('artist');

    Route::get('/videos/{project:id}', [GalleryController::class, 'show'])->name('videos');

    Route::get('/videos', function () {
        return redirect()->route('gallery');
    });

    // TODO: untuk playlist project mending formnya berbentuk modal, bisa nambah di project detail atau video detail.
});

Route::get('/ai-models', [AIModelController::class, 'index'])->name('ai-model');

Route::get('/about-us', [InformationController::class, 'aboutUs'])->name('about-us');

Route::get('/privacy-and-policy', [InformationController::class, 'privacyAndPolicy'])->name('privacy-and-policy');

Route::get('/terms-and-conditions', [InformationController::class, 'termsAndConditions'])->name('terms-and-conditions');

Route::get('/tutorials', [TutorialController::class, 'index'])->name('tutorials');

// TODO: Bikin Halaman Baru (Support Page) tambahkan Button atau widget dari buy me a coffee dan ko-fi

Route::prefix('discography')->group(function () {
    Route::get('/explore', [AlbumController::class, 'index'])->name('discography-explore');

    Route::get('/artists/{artist:codename}', [AlbumController::class, 'showArtist'])->name('discography-artist');

    Route::get('/albums/{album:id}', [AlbumController::class, 'show'])->name('discography-album');

    // TODO: Bikin Song Detail Terpisah
});

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');

Route::post('/login', [LoginController::class, 'authenticate'])->name('login-post');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/auth/google/redirect', [LoginController::class, 'googleLoginRedirect'])->name('google.login');

Route::get('/auth/google/callback/', [LoginController::class, 'googleLoginCallback'])->name('google.callback');

// TODO: Need an email
Route::get('/sign-up', [SignUpController::class, 'index'])->name('sign-up')->middleware('guest');

Route::post('/sign-up', [SignUpController::class, 'store'])->name('sign-up-post');

Route::get('/verification', [SignUpController::class, 'verification'])->name('verify-email')->middleware('guest');

Route::get('/email/verify', [EmailVerificationController::class, 'sentEmailVerification'])->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verificationSuccess'])->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationController::class, 'resendVerification'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/forgot-password', [ResetPasswordController::class, 'index'])->middleware('guest')->name('password.request');

Route::post('/forgot-password', [ResetPasswordController::class, 'sendEmail'])->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'resetPasswordView'])->middleware('guest')->name('password.reset');

Route::post('/reset-password', [ResetPasswordController::class, 'update'])->middleware('guest')->name('password.update');

// Account
Route::prefix('account')->group(function () {
    Route::get('/profile', [AccountController::class, 'index'])->middleware('auth')->name('profile');

    Route::put('/profile', [AccountController::class, 'update'])->name('account.update');

    Route::put('/picture', [AccountController::class, 'updateProfilePicture'])->name('account.profile.update');

    Route::delete('/picture', [AccountController::class, 'removeProfilePicture'])->name('account.profile.remove');

    Route::get('/requests', [AccountController::class, 'requests'])->middleware('auth')->name('my-request');

    Route::put('/password', [AccountController::class, 'changePassword'])->name('password.change');
});

// Dashboard
Route::prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard')->middleware('admin');

    Route::resource('/ai-models', DashboardAIModelController::class)->middleware('admin');

    Route::resource('/albums', DashboardAlbumController::class)->middleware('admin');

    Route::resource('/album-artist', DashboardAlbumArtistController::class)->middleware('admin');

    Route::resource('/artists', DashboardArtistController::class)->middleware('admin');

    Route::resource('/categories', DashboardCategoryController::class)->middleware('admin');

    Route::resource('/companies', DashboardCompanyController::class)->middleware('admin');

    Route::resource('/genres', DashboardGenreController::class)->middleware('admin');

    Route::resource('/idols', DashboardIdolController::class)->middleware('admin');

    Route::resource('/member-group', DashboardMemberGroupController::class)->middleware('admin');

    Route::resource('/playlists', DashboardPlaylistController::class)->middleware('admin');

    Route::resource('/playlist-project', DashboardPlaylistProjectController::class)->middleware('admin');

    Route::resource('/projects', DashboardProjectController::class)->middleware('admin');

    Route::resource('/project-artist', DashboardProjectArtistController::class)->middleware('admin');

    Route::resource('/project-types', DashboardProjectTypeController::class)->middleware('admin');

    Route::resource('/songs', DashboardSongController::class)->middleware('admin');

    Route::resource('/song-artist', DashboardSongArtistController::class)->middleware('admin');

    Route::resource('/song-genre', DashboardSongGenreController::class)->middleware('admin');
});
