<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ShoeType;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    public function productList($amt = 'default'){
        $product = Product::select('shoe_types.type as type','products.id','products.name','products.new_price',
                                    'products.stock','products.image','products.shoe_type_id')
                            ->leftJoin('shoe_types','products.shoe_type_id','shoe_types.id')
                            ->when(request('search'),function($query){
                                $query->whereAny(['products.name','shoe_types.type'],'like',
                                '%'.request('search').'%'
                            );
                            });
        if($amt != 'default'){
            $product = $product->where('stock','<',5);
        }
        $totalProduct = $product->count();
        $product = $product->orderBy('products.id','desc')->paginate(4);
        return view('admin.productList.productList',compact('product','totalProduct'));
    }

    public function addProductPage(){
        $type = ShoeType::all();
        return view('admin.productList.addProduct',compact('type'));
    }

    public function addProduct(Request $request){
        $this->validateProduct($request, 'create');
        $product = $this->requestProductData($request);
        if($request->hasFile('image')){
            $filename = uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path().'/product/',$filename);
            $product['image'] = $filename;
        }
        Product::create($product);
        Alert::success('Success','Add New Product Successfully');
        return to_route('Admin#productList');
    }

    public function deleteProduct($id){
        if(file_exists(public_path('/product/'.Product::find($id)->image))){
            unlink(public_path('/product/'.Product::find($id)->image));
        }
        Product::find($id)->delete();
        Alert::success('Success','Delete Shoe Successfully');
        return back();
    }

    public function detailProduct($id){
        $product = Product::select('shoe_types.type as type','products.id','products.name','products.new_price',
                                    'products.stock','products.image','products.shoe_type_id','products.short_desc'
                                    ,'products.long_desc','products.old_price')
                                    ->leftJoin('shoe_types','products.shoe_type_id','shoe_types.id')
                                    ->find($id);
        return view('admin.productList.detailProduct',compact('product'));
    }

    public function editProductPage($id){
        $product = Product::find($id);
        $shoeType = ShoeType::get();
        return view('admin.productList.editProduct',compact('product','shoeType'));
    }

    public function editProduct(Request $request,$id){
        $this->validateProduct($request,'update');
        $product = $this->requestProductData($request);
        if($request->hasFile('image')){
            if(file_exists(public_path('/product/'.$request->oldImage))){
                unlink(public_path('/product/'.$request->oldImage));
            }
            $filename = uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path().'/product/',$filename);
            $product['image'] = $filename;
        }else{
            $product['image'] = $request->oldImage;
        }
        Product::find($id)->update($product);
        Alert::success('Success','Shoe detail edit successfully');
        return to_route('Admin#detailProduct',$id);
    }

    private function validateProduct($request,$action){
        $rule = [
            'name' => 'required',
            'newPrice' => 'required',
            'shortDesc' => 'required',
            'longDesc' => 'required',
            'stock' => 'required',
            'shoeType' => 'required',

        ];

        $rule['image'] = $action == 'create' ? 'required|mimes:jpeg,jpg,png,svg,webp|file' : 'mimes:jpeg,jpg,png,svg,webp|file';
        $request->validate($rule);
    }

    private function requestProductData($request){
        return [
            'name' => $request->name,
            'new_price' => $request->newPrice,
            'old_price' => $request->oldPrice,
            'short_desc' => $request->shortDesc,
            'long_desc' => $request->longDesc,
            'stock' => $request->stock,
            'shoe_type_id' => $request->shoeType,
        ];
    }


}
