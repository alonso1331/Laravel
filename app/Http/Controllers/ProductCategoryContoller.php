<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryContoller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productCategories = ProductCategory::get();

        return view('admin.product-category.index', compact('productCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product-category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        ProductCategory::create($request->all());

        return redirect()->route('product-categories.index');
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
        $productCategory = ProductCategory::find($id);

        return view('admin.product-category.edit', compact('productCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        ProductCategory::find($id)->update($request->all());

        return redirect()->route('product-categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $productCategory = ProductCategory::with('products')->find($id);

        // 判斷陣列是否為空，當有產品使用該類別時，就走if的函式
        if($productCategory->products->count()){
            return redirect()
            ->route('product-categories.index')
            ->with([
                'message' => $productCategory->name.'類別尚有'.$productCategory->products->count().'商品使用中，如欲刪除，請修改所屬商品的類別',
                'color' => 'alert-danger'
            ]);
        }

        $productCategory->delete();

        return redirect()
        ->route('product-categories.index')
        ->with([
            'message' => '刪除成功!',
            'color' => 'alert-success'
        ]);
    }
}
