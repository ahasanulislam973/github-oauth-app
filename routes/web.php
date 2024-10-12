<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GitHubController;
use App\Http\Controllers\GitHubUserController;


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
    return view('index');
});

Route::get('/auth/github', [GitHubController::class, 'redirectToGitHub'])->name('login.github');
Route::get('/auth/github/callback', [GitHubController::class, 'handleGitHubCallback']);

Route::get('/github/profile/{github_id}', [GitHubUserController::class, 'showProfile'])->name('github.profile');
