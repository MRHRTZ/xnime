<?php

use App\Http\Controllers\AnimeController;
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

Route::get('/', [HomeController::class, 'index'])->name('beranda');
Route::get('/anime', [AnimeController::class, 'index'])->name('anime');
Route::get('/anime-detail', [AnimeController::class, 'detail'])->name('detail-anime');
Route::get('/search', [AnimeController::class, 'search'])->name('search');
Route::get('/schedule', [AnimeController::class, 'schedule'])->name('schedule');
Route::get('/episode/{anime_id}/{episode_id}', [EpisodeController::class, 'index'])->name('episodes');
Route::get('/series', [AnimeController::class, 'series'])->name('series');
Route::get('/movie', [AnimeController::class, 'movie'])->name('movie');
Route::get('/live-action', [AnimeController::class, 'live_action'])->name('live-action');
Route::get('/bookmark', [BookmarkController::class, 'index'])->name('bookmark');
Route::get('/fetch-anime', [AnimeController::class, 'fetch_anime'])->name('fetch-anime');

