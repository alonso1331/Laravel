<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class FrontController extends Controller
{
    //
    public function index()
    {
        return view('index');
    }

    public function hello()
    {
        // return view('hello',['id' => $id]);
        $name = 'victoria';
        $age = 28;
        // return view('hello', ['name' => $name, 'age' => $age, 'id' => $id]);
        return view('hello', compact('name', 'age'));
    }


    public function news()
    {
        $news = DB::table('news')->get();
        return view('news', compact('news'));
    }

    public function newsDetail($id)
    {
        // $news = DB::table('news')->find($id);
        // $news = DB::table('news')->where('id', $id)->get();
        $news = DB::table('news')->where('id', $id)->first();
        return view('detail', compact('news'));
    }
}
