<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\ToolController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Admin Routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth:sanctum'])->prefix('dashboard')->group(function () {
    Route::get('clear-cache', function() {
        Artisan::call('cache:clear');
        Artisan::call('route:clear');
        Artisan::call('config:clear');
        Artisan::call('view:clear');
        return redirect()->back()->with(['msg' => 'Cache Cleared', 'type' => 'success']);
    });
});
Route::middleware(['auth:sanctum'])->prefix('dashboard')->group(function () {
    Route::get('profile/edit/{id}', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('profile/change-password', [ProfileController::class, 'change_password_edit'])->name('profile.change_password_edit');
    Route::put('profile/change-password/update', [ProfileController::class, 'change_password_update'])->name('profile.change_password_update');

});


Route::get('/create', [ToolController::class, 'index'])->name('tool.index');

Route::post('/template', [TemplateController::class, 'store'])->name('template.store');
Route::get('/edit/{id}', [TemplateController::class, 'edit'])->name('template.edit');
Route::put('/edit/{id}', [TemplateController::class, 'update'])->name('template.update');
Route::delete('/edit/{id}', [TemplateController::class, 'destroy'])->name('template.destroy');


Route::middleware(['auth:sanctum'])->prefix('dashboard')->group(function () {
    Route::get('elements/add', [\App\Http\Controllers\ElementsController::class, 'create'])->name('elements.add');
    Route::post('elements', [\App\Http\Controllers\ElementsController::class, 'store'])->name('elements.store');
});



Route::get('/', [HomeController::class, 'index'])->name('home');
