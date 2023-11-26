<?php

use App\Http\Controllers\AnimeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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

// Main Pages
Route::get('/', [HomeController::class, 'index'])->name('beranda');
Route::get('/anime', [AnimeController::class, 'index'])->name('anime');
Route::get('/anime-detail', [AnimeController::class, 'detail'])->name('detail-anime');
Route::get('/search', [AnimeController::class, 'search'])->name('search');
Route::get('/schedule', [AnimeController::class, 'schedule'])->name('schedule');
Route::get('/episode/{anime_id}/{episode_id}', [EpisodeController::class, 'index'])->name('episodes');
Route::get('/bookmark', [BookmarkController::class, 'index'])->name('bookmark');

// Function
Route::post('/fetch-popular', [EpisodeController::class, 'fetch_popular'])->name('fetch-popular');
Route::post('/report-broken', [EpisodeController::class, 'report_broken'])->name('report-broken');
Route::post('/update-history', [EpisodeController::class, 'update_history'])->name('update-history');
Route::post('/fetch-comment', [EpisodeController::class, 'fetch_comment'])->name('fetch-comment');
Route::post('/post-comment', [EpisodeController::class, 'post_comment'])->name('post-comment');
Route::post('/delete-comment', [EpisodeController::class, 'delete_comment'])->name('delete-comment');
Route::post('/post-like', [EpisodeController::class, 'post_like'])->name('post-like');
Route::post('/post-bookmark', [BookmarkController::class, 'post_bookmark'])->name('post-bookmark');
Route::post('/delete-bookmark', [BookmarkController::class, 'delete_bookmark'])->name('delete-bookmark');
Route::post('/delete-history', [BookmarkController::class, 'delete_history'])->name('delete-history');

// Auth Pages
Route::get('/login', [AuthController::class, 'view_login'])->name('login');
Route::get('/register', [AuthController::class, 'view_register'])->name('register');
Route::get('/profile', [AuthController::class, 'view_profile'])->name('profile');

// Auth Process
Route::post('/profile/upload', [AuthController::class, 'upload_profile'])->name('upload_profile');
Route::post('/profile/process', [AuthController::class, 'profile_process'])->name('profile_process');
Route::post('/register/process', [AuthController::class, 'register_process'])->name('register_process');
Route::post('/login/process', [AuthController::class, 'login_process'])->name('login_process');
Route::post('/logout/process', [AuthController::class, 'logout_process'])->name('logout_process');
