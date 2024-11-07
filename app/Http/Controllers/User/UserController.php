<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ShoeType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

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
        $product = Product::select('products.id','products.name','products.image','products.old_price',
                                    'products.new_price','products.stock','products.shoe_type_id','products.created_at')
                            ->leftJoin('shoe_types','products.shoe_type_id','shoe_types.id')

                            ->when(request('typeId'),function($query){
                                $query->where('products.shoe_type_id',request('typeId'));
                            })

                            ->when(request('search'), function($query){
                                $query->where('products.name','like','%'.request('search').'%');
                            })

                            ->when(request('minPrice') !== null && request('maxPrice') !== null,function($query){
                                $query= $query->whereBetween('products.new_price',[request('minPrice'),request('maxPrice')]);
                            })

                            ->when(request('minPrice') !== null && request('maxPrice') === null,function($query){
                                $query= $query->where('products.new_price','>=',request('minPrice'));
                            })

                            ->when(request('minPrice') === null && request('maxPrice') !== null,function($query){
                                $query= $query->where('products.new_price','<=',request('maxPrice'));
                            })

                            ->orderBy('created_at', 'desc')
                            ->paginate(6);
        $type = ShoeType::get();
        return view('user.shop',compact('product','type'));
    }

}
