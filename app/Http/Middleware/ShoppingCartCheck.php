<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ShoppingCartCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 如果購物車是空的，跳轉商品列表頁面
        if(\Cart::isEmpty()){
            return redirect()
                ->route('products.list')
                ->with([
                    'message' => '請先將商品加入購物車'
                ]);
        };
        return $next($request);
    }
}
