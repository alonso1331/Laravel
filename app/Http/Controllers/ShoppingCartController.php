<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShoppingCartController extends Controller
{
    public function add(Request $request)
    {
        // 取得要加入購物車商品的資訊
        $product = Product::find($request->id);

        \Cart::add(array(
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $request->qty,
            'attributes' => array(
                'image_url' => $product->image_url
            )
            // 'associatedModel' => $product

            // 'id' => 1,
            // 'name' => 'prouducts',
            // 'price' => 62.3,
            // 'quantity' => 4,
            // 'attributes' => array(),
        ));

        return 'success';
    }

    // public function update(Request $request)
    // {

    // }

    public function content()
    {
        $items = \Cart::getContent();
        dd($items);
        // foreach($items as $row) {

        //     echo $row->id; // row ID
        //     echo $row->name;
        //     echo $row->qty;
        //     echo $row->price;

        //     echo $item->associatedModel->id; // whatever properties your model have
        //     echo $item->associatedModel->name; // whatever properties your model have
        //     echo $item->associatedModel->description; // whatever properties your model have
        // }
    }

    public function clear()
    {
        \Cart::clear();

        return 'clear';
    }

    public function step01()
    {
        $items = \Cart::getContent();
        // dd($items);

        return view('front.shopping-cart.step01', compact('items'));
    }

    public function step02()
    {
        return view('front.shopping-cart.step02');
    }

    public function step03()
    {
        return view('front.shopping-cart.step03');
    }

    public function step04()
    {
        return view('front.shopping-cart.step04');
    }
}
