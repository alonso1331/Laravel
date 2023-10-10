<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FrontController;


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

// Route::get('/', function () {
//     return view('index');
// });
// laravel 7以前適用
// Route::get('/', 'FrontController@index');
// laravel 7以後用
Route::get('/', [FrontController::class, 'index']);

// Route::get('/hello', function () {
//     // 方法一
//     // return view('hello', ['name' => 'victoria']);
//     // 方法二
//     // $name = 'pilar';
//     // return view('hello')->with('name', $name);
//     // 方法三 在function()括號裡帶參數
// });

Route::get('/hello', [FrontController::class, 'hello']);

Route::get('/news', [FrontController::class, 'news']);

Route::get('/news/{id}', [FrontController::class, 'newsDetail']);

Route::get('/create-news',[FrontController::class, 'createNews']);

Route::post('/store-news',[FrontController::class, 'storeNews']);

Route::get('/update-news/{id}',[FrontController::class, 'updateNews']);

Route::get('/delete-news/{id}', [FrontController::class, 'destoryNews']);

Route::post('/contact', [FrontController::class, 'contact']);

// Route::post('/create-news', [FrontController::class, 'createNews']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
