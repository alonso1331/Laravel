<?php

use App\Http\Controllers\FacilityController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\NewsController;
use App\Models\facility;
use App\Models\News;

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

// 前台
Route::get('/', [FrontController::class, 'index']);

Route::get('/welcome', [FrontController::class, 'welcome']);

Route::get('/login', [FrontController::class, 'login']);

Route::prefix('news')->group(function (){
    Route::get('/', [FrontController::class, 'newsList']);
    Route::get('/{id}', [FrontController::class, 'newsDetail']);
});

Route::get('/create-news',[FrontController::class, 'createNews']);

Route::post('/contact', [FrontController::class, 'contact']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// 後台
Route::prefix('/admin')->middleware(['auth'])->group(function (){
    // 最新消息
    // Route::resource('/news', NewsController::class);

    Route::prefix('/news')->group(function (){
        // 後台列表頁
        Route::get('/', [NewsController::class, 'index'])->name('news.index');
        Route::get('/create', [NewsController::class, 'create'])->name('news.create');
        Route::post('/',[NewsController::class, 'store'])->name('news.store');
        Route::get('/{id}/edit', [NewsController::class, 'edit'])->name('news.edit');
        Route::patch('/{id}',[NewsController::class, 'update'])->name('news.update');
        Route::delete('/{id}', [NewsController::class, 'destroy'])->name('news.destroy');
    });

    // 設施介紹
    Route::prefix('/facility')->group(function(){
        Route::get('/', [FacilityController::class, 'index'])->name('facility.index');
        Route::get('/create', [FacilityController::class, 'create'])->name('facility.create');
        Route::post('/',[FacilityController::class, 'store'])->name('facility.store');
        Route::get('/{id}/edit', [FacilityController::class, 'edit'])->name('facility.edit');
        Route::patch('/{id}',[FacilityController::class, 'update'])->name('facility.update');
        Route::delete('/{id}', [FacilityController::class, 'destroy'])->name('facility.destroy');
    });

});
