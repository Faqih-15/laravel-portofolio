<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\depanController;
use App\Http\Controllers\skillController;
use App\Http\Controllers\halamanController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\projectController;
use App\Http\Controllers\educationController;
use App\Http\Controllers\experienceController;
use App\Http\Controllers\pengaturanHalamanController;

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

Route::get('/', [depanController::class, 'index']);

Route::redirect('home', 'dashboard');

Route::get('/auth', [authController::class, 'index'])->name('login');

Route::get('/auth/redirect', [authController::class, 'redirect'])->middleware('guest');

Route::get('/auth/callback', [authController::class, 'callback'])->middleware('guest');

Route::get('/auth/logout', [authController::class, 'logout']);


Route::prefix('dashboard')->middleware('auth')->group(
    function () {
        Route::get('/', [halamanController::class, 'index']);
        Route::resource('halaman', halamanController::class);
        Route::resource('experience', experienceController::class);
        Route::resource('education', educationController::class);
        Route::resource('project', projectController::class);
        Route::delete('project/image/{id}', [ProjectController::class, 'destroyImage'])->name('project.image.destroy');
        Route::post('project/upload-image', [ProjectController::class, 'uploadImage'])->name('project.image.upload');
        Route::post('project/revert-image', [ProjectController::class, 'revertImage'])->name('project.image.revert'); // kalo DELETE error karna server lokal(sederhana) tidak mengenalinya beda dgn server besar
        Route::get('skill', [skillController::class, 'index'])->name('skill.index');
        Route::post('skill', [skillController::class, 'update'])->name('skill.update');
        Route::get('profile', [profileController::class, 'index'])->name('profile.index');
        Route::post('profile', [profileController::class, 'update'])->name('profile.update');
        Route::get('pengaturanHalaman', [pengaturanHalamanController::class, 'index'])->name('pengaturanHalaman.index');
        Route::post('pengaturanHalaman', [pengaturanHalamanController::class, 'update'])->name('pengaturanHalaman.update');
    }
);
