<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// User Edit Route
require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route for users to display all users
Route::get('/users', [UserController::class, 'users'])->name('users.list');
// Delete Route
Route::delete('users/{id}', [UserController::class, 'delete'])->name('users.delete');
// Edit user Route
Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
// Update user Route
Route::put('/users/update/{id}', [UserController::class, 'update'])->name('users.update');
// Create New user
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users/store', [UserController::class, 'store'])->name('users.store');

