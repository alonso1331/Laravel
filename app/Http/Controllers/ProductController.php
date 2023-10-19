<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('productCategories')->orderBy('created_at', 'desc')->get();

        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productCategories = ProductCategory::get();

        return view('admin.product.create', compact('productCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 判斷主要圖片有沒有上傳
        if($request->hasFile('image_url')){
            $path = Storage::put('/product', $request->image_url);
        }

        // 建立產品
        $product = Product::create([
            'product_category_id' => $request->product_category_id,
            'name' => $request->name,
            'descripte' => $request->descripte,
            'price' => $request->price,
            'image_url'=> $path
        ]);

        // 儲存其他圖片，利用迴圈讀出檔案
        foreach ($request->image_urls??[] as $image_url) {
            $path = Storage::put('/product', $image_url);

            ProductImage::create([
                'product_id' => $product->id,
                'image_url' => $path
            ]);
        }

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::with('productImages')->find($id);
        $productCategories = ProductCategory::get();
        // $product_images = ProductImage::where('product_id', $product->id)->get();
        // dd($product);
        return view('admin.product.edit', compact('product', 'productCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);

        // 判斷主要圖片是否更新
        if($request->hasFile('image_url')){
            // 刪除舊圖片
            Storage::delete($product->image_url);
            // 上傳新圖片
            $path = Storage::put('/product', $request->image_url);
        }else{
            // 沿用舊圖片
            $path = $product->image_url;
        }

        $product->update([
            'product_category_id' => $request->product_category_id,
            'name' => $request->name,
            'descripte' => $request->descripte,
            'price' => $request->price,
            'image_url' => $path,
        ]);

        // 其他圖片是否更新，這裡的做法不用刪除舊圖片，只要上傳新圖片就好
        if($request->hasFile('image_urls')){
            foreach ($request->image_urls??[] as $image_url) {
                $path = Storage::put('/product', $image_url);

                ProductImage::create([
                    'product_id' => $product->id,
                    'image_url' => $path
                ]);
            }
        }

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // 找出該筆資料
        $product = Product::with('productImages')->find($id);
        // 先刪除其在Stroage的圖片
        Storage::delete($product->image_url);
        // 再找出其他圖片
        // $productImages = ProductImage::where('product_id', $product->id)->get();
        // 用迴圈一個一個刪除
        foreach ($product->productImages as $productImage) {
            // 刪除在Stroage的圖片
            Storage::delete($productImage->image_url);
            // 刪除該筆在資料庫的資料
            $productImage->delete();
        }
        // 刪除在資料庫的資料
        $product -> delete();

        return redirect()->route('products.index');
    }

    public function imageDelete(Request $request)
    {
        // dd($request->all());
        // 在其他圖片資料表中，用id找出對應的圖片
        $productImage = ProductImage::find($request->id);
        // 將圖片刪除
        Storage::delete($productImage->image_url);
        // 將圖片從資料庫移除
        $productImage -> delete();

        return 'success';
    }
}
