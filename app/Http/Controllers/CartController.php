<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;


class CartController extends Controller
{
    public function addToCart(Request $request){
        Cart::create([
           'user_id' => $request->userId,
           'product_id' => $request->productId,
           'qty' => $request->count
        ]);
        Alert::success('Success', 'Product added to cart');
        return back();
    }

    public function UserCart(){
        $cart = Cart::select('products.id','products.name','products.image','products.new_price',
                            'carts.id','carts.qty')
                        ->leftJoin('products','carts.product_id','products.id')
                        ->where('carts.user_id',Auth::user()->id)
                        ->get();
        $total = 0;
        foreach($cart as $item){
            $total += $item->new_price * $item->qty;
        }
        return view('user.cart',compact('cart','total'));
    }
}
