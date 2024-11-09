<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
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
                            'carts.id','carts.qty','carts.product_id')
                        ->leftJoin('products','carts.product_id','products.id')
                        ->where('carts.user_id',Auth::user()->id)
                        ->get();
        $total = 0;
        foreach($cart as $item){
            $total += $item->new_price * $item->qty;
        }
        return view('user.cart',compact('cart','total'));
    }

    public function deleteCart($id){
        Cart::find($id)->delete();
        Alert::success('Success', 'Product deleted from cart');
        return back();
    }

    public function cartTemp(Request $request){ 
        $orderArray = [];
        foreach($request->all() as $item){
            array_push($orderArray,[
                'user_id' => $item['user_id'],
                'product_id' => $item['product_id'],
                'product_name' => $item['product_name'],
                'each_total' => $item['each_total'],
                'count' => $item['qty'],
                'status' => 0,
                'order_code' => $item['order_code'],
                'total_amount' => $item['total_amount']
            ]);
        }
        Session::put('tempCart',$orderArray);
        return response()->json([
            'status' => 'success'
        ],200);
    }
} 
