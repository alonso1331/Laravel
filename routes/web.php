<?php

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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/hello', function () {
//     // 方法一
//     // return view('hello', ['name' => 'victoria']);
//     // 方法二
//     // $name = 'pilar';
//     // return view('hello')->with('name', $name);
//     // 方法三 在function()括號裡帶參數
// });

Route::get('/hello/{id}', function ($id) {
    // return view('hello',['id' => $id]);
    $name = 'victoria';
    $age = 28;
    return view('hello', ['name' => $name, 'age' => $age, 'id' => $id]);
    return view('hello', compact('name', 'age', 'id'));
});
