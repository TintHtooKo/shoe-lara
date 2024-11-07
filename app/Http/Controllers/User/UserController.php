<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function UserHome(){
        $product = Product::select('products.id','products.name','products.image','products.old_price',
                                    'products.new_price','products.stock')
                            ->orderBy('created_at', 'desc')->take(4)->get();
        return view('user.dashboard',compact('product'));
    }

    public function productDetail($id){
        $product = Product::select('shoe_types.type as type','products.id','products.name','products.new_price',
                                    'products.stock','products.image','products.shoe_type_id','products.short_desc'
                                    ,'products.long_desc','products.old_price')
                                    ->leftJoin('shoe_types','products.shoe_type_id','shoe_types.id')
                                    ->find($id);
        return view('user.productDetail',compact('product'));
    }

    public function UserContact(){
        return view('user.contact');
    }

    public function UserShop(){
        return view('user.shop');
    }

    public function UserCart(){
        return view('user.cart');
    }
}
