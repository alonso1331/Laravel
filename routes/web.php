<?php

use Illuminate\Support\Facades\Route;
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
