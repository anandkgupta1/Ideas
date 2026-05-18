<?php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Dashboard route
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::post('/follow/{followed_id}', [DashboardController::class, 'followUser'])->middleware('auth');

// Route for the search functionality
Route::get('/search', [DashboardController::class, 'search'])->name('search');


// Static view routes
Route::get('/terms', fn() => view('term'))->name('terms');
Route::get('/profile', fn() => view('profile'))->name('profile');
Route::get('/explore', fn() => view('explore'))->name('explore');
Route::get('/setting', fn() => view('setting'))->name('setting');
Route::get('/support', fn() => view('support'))->name('support');

// Registration routes
Route::get('layout/register', fn() => view('layout.register'));
Route::post('layout/register', [RegisteredUserController::class, 'store'])->name('register');

// Login routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Ideas routes
Route::get('/ideas', [IdeaController::class, 'index'])->name('ideas.index');
Route::post('/ideas', [IdeaController::class, 'store'])->name('ideas.store');
Route::post('/ideas/{id}/like', [IdeaController::class, 'likeIdea'])->name('ideas.like');

//Feedback route
Route::middleware('auth')->group(function () {
    Route::get('/feedback', [FeedController::class, 'showFeedbackForm'])->name('feedback.form');
    Route::post('/feedback', [FeedController::class, 'storeFeedback'])->name('feedback.store');
});

// Profile Route
Route::get('/profile-data', function() {
    return response()->json(Auth::user());
})->name('profile.data');



