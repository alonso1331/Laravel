<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use League\CommonMark\Node\Query\OrExpr;

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

    public function update(Request $request)
    {
        // 找到購物車要更新的產品id
        $product = Product::find($request->id);

        // 更新購物車
        \cart::update($product->id, array(
            'quantity' => array(
                'relative' => false,
                'value' => $request->qty
            ),
        ));

        // 取出該商品的數量
        $item = \Cart::get($product->id);
        dd($item);

        // 返回該商品目前資料庫更新的數量
        // return $item;
    }

    public function content()
    {
        $items = \Cart::getContent();
        // dd($items);

        return view('front.shopping-cart.step01');
    }

    public function clear()
    {
        \Cart::clear();

        return 'clear';
    }

    public function step01()
    {
        $items = \Cart::getContent()->sortBy('id');
        // dd($items);

        return view('front.shopping-cart.step01', compact('items'));
    }

    public function step02()
    {
        return view('front.shopping-cart.step02');
    }

    public function step02Store(Request $request)
    {
        // payment 0:信用卡付款 1:網路 ATM 2:超商代碼
        // shipment 0:黑貓宅配 1:超商店到店
        // dd($request->all());
        session([
            'payment' => $request->payment,
            'shipment' => $request->shipment
        ]);

        // dd(session()->all());
        return redirect()->route('shopping-cart.step03');
    }

    public function step03()
    {
        return view('front.shopping-cart.step03');
    }

    public function step03Store(Request $request)
    {
        // 建立訂單
        $order = Order::create([
            // 用time()生成訂單編號
            'order_no' => 'DP'.time(),
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'payment' => session('payment'),
            'shipment' => session('shipment'),
        ]);

        // 把購物車的內容找出來後，存到資料庫裡
        $items = \Cart::getContent();
        foreach ($items as $item){
            $product = Product::find($item->id);
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'name'  => $product->name,
                'price' => $product->price,
                'qty' => $item->quantity,
                'image_url' => $product->image_url
            ]);
        }
        // 清空購物車
        \Cart::clear();
        return redirect()->route('shopping-cart.step04', ['order_no'=>$order->order_no]);
    }

    public function step04($orderNo)
    {
        // 藉由step03 產生的DP 訂單編號，作為索引找出資料庫的資料
        $order = Order::with('orderDetails')->where('order_no', $orderNo)->first();

        return view('front.shopping-cart.step04', compact('order'));
    }
}
