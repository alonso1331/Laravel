<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use TsaiYiHua\ECPay\Checkout;
use League\CommonMark\Node\Query\OrExpr;
use TsaiYiHua\ECPay\Services\StringService;
use TsaiYiHua\ECPay\Collections\CheckoutResponseCollection;

class ShoppingCartController extends Controller
{
    public function __construct(Checkout $checkout, CheckoutResponseCollection $checkoutResponse)
    {
        $this->checkout = $checkout;
        $this->checkoutResponse = $checkoutResponse;
    }

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
        \Cart::update($product->id, array(
            'quantity' => array(
                'relative' => false,
                'value' => $request->qty
            ),
        ));

        // 取出該商品的數量
        $item = \Cart::get($product->id);
        // dd($item);

        // 返回該商品目前資料庫更新的數量
        return $item;
    }

    public function destroy(Request $request)
    {
        \Cart::remove($request->id);

        return 'success';
    }

    // public function content()
    // {
    //     $items = \Cart::getContent();
    //     // dd($items);

    //     return view('front.shopping-cart.step01');
    // }

    // public function clear()
    // {
    //     \Cart::clear();

    //     return 'clear';
    // }

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
        // 要傳給綠界的商品訊息
        $itemInfo = [];

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

            $new_ary = [
                'name' => $product->name,
                'qty' => $item->quantity,
                'price' => $product->price,
                'unit' => '個'
            ];
            // 把上述陣列存進$itemInfo
            array_push($itemInfo, $new_ary);
        }

        $new_ary = [
            'name' => '運費',
            'qty' => 1,
            'price' => 60,
            'unit' => '個'
        ];
        array_push($itemInfo, $new_ary);

        // 第三分支付
        $formData = [
            'UserId' => 1,
            'ItemDescription' => '產品簡介',
            'Items' => $itemInfo,
            'OrderId' => $order->order_no,
            'PaymentMethod' => 'Credit',
        ];

        // 清空購物車
        \Cart::clear();

        // 用套件將表單$formData 送出

        return $this->checkout->setNotifyUrl(route('notify'))->setReturnUrl(route('return'))->setPostData($formData)->send();
        // return redirect()->route('shopping-cart.step04', ['order_no'=>$order->order_no]);
    }

    public function step04($orderNo)
    {
        // 藉由step03 產生的DP 訂單編號，作為索引找出資料庫的資料
        $order = Order::with('orderDetails')->where('order_no', $orderNo)->first();

        return view('front.shopping-cart.step04', compact('order'));
    }

    public function notifyUrl(Request $request)
    {
        $serverPost = $request->post();
        $checkMacValue = $request->post('CheckMacValue');
        unset($serverPost['CheckMacValue']);
        $checkCode = StringService::checkMacValueGenerator($serverPost);
        if($checkMacValue == $checkCode) {
            $order = Order::where('order_no', $request->MerchantTradeNo)->first();
            if($request->RtnCode == 1){
                // 簡便寫法
                // $order->is_paid = 1;
                // 正規寫法
                $order->update([
                    'is_paid' => 1
                ]);
            }
            return '1|OK';
        }else{
            return '0|FAIL';
        }
    }

    public function returnUrl(Request $request)
    {
        $serverPost = $request->post();
        // dd($serverPost);
        $checkMacValue = $request->post('CheckMacValue');
        unset($serverPost['CheckMacValue']);
        $checkCode = StringService::checkMacValueGenerator($serverPost);
        if($checkMacValue == $checkCode) {
            if(!empty($request->input('redirect'))){
                return redirect($request->input('redirect'));
            }else{
                // dd($this->checkoutResponse->collectResponse($serverPost));
                $order = Order::where('order_no', $request->MerchantTradeNo)->first();
                if($request->RtnCode == 1){
                    $order->update([
                        'is_paid' => 1
                    ]);
                }
            }
            return redirect()->route('shopping-cart.step04', ['order_no'=>$request->MerchantTradeNo]);
        }
    }
}
