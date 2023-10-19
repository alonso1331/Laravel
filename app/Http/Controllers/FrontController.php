<?php

namespace App\Http\Controllers;


use App\Models\News;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Validator;


class FrontController extends Controller
{

    public function index()
    {
        return view('index');
    }

    public function welcome()
    {
        return view('welcome');
    }

    public function contact(Request $request)
    {
        $validatedData = $request->validate([
            'email'=>'email',
            'g-recaptcha-response' => 'recaptcha',
            recaptchaFieldName() => recaptchaRuleName()
        ]);

        // $validator = Validator::make(request()->all(), [
        //     'g-recaptcha-response' => 'recaptcha',
        //     recaptchaFieldName() => recaptchaRuleName()
        // ]);

        // // check if validator fails
        // if($validator->fails()) {
        //     $errors = $validator->errors();
        //     return redirect('/')
        //             ->withErrors($validator)
        //             ->withInput();
        // }

        Contact::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'message' => $request->message
        ]);

        return redirect('/');
    }

    public function newsList()
    {
        // $news = DB::table('news')->get();
        $news = News::get();
        return view('front.news.list', compact('news'));
    }

    public function newsDetail($id)
    {
        // $news = DB::table('news')->find($id);
        // $news = DB::table('news')->where('id', $id)->get();
        // $news = DB::table('news')->where('id', $id)->first();
        $news = News::where('id', $id)->first();

        return view('front.news.detail', compact('news'));
    }

    public function facility()
    {
        $facilities = Facility::get();
        return view('front.facility.list', compact('facilities'));
    }

    public function productList(Request $request)
    {
        $productCategories = ProductCategory::get();

        if($request->category_id){
            $products = Product::where('product_category_id', $request->category_id)->get();
        }else{
            $products = Product::get();
        }

        return view('front.product.list', compact('products', 'productCategories'));
    }

    public function productDetail($id)
    {
        // with()的設定，要先在model建立好hasMany()的關聯性，就不用從ProductImage去找關聯
        $products = Product::with('productImages')->find($id);
        // $productImages = ProductImage::where('product_id', $products->id)->get();

        return view('front.product.detail', compact('products'));
    }

    public function login(){
        return view('auth.login');
    }
}
