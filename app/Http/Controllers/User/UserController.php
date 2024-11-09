<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\ShoeType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
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

    public function UserCheckoutPage(){
        $orderProduct = Session::get('tempCart');
        return view('user.checkout',compact('orderProduct'));
    }

    public function UserCheckout(Request $request){
       $this->validatePayment($request);
       $data = $this->paymentData($request);

       if($request->hasFile('paySlip')){
        $filename = uniqid().$request->file('paySlip')->getClientOriginalName();
        $request->file('paySlip')->move(public_path().'/payslip/',$filename);
        $data['payslip_img'] = $filename;
       }

       Payment::create($data);
       
       $orderProduct = Session::get('tempCart');
       
       foreach ($orderProduct as $item) {
        Order::create([
            'product_id' => $item['product_id'],
            'user_id' => $item['user_id'],
            'count' => $item['count'],
            'status' => $item['status'],
            'order_code' => $item['order_code'],
           ]);

           $product = Product::find($item['product_id']);
           if ($product) {
               $product->stock -= $item['count'];
               $product->save();
           }
           Cart::where('user_id',$item['user_id'])->where('product_id',$item['product_id'])->delete();
       }
       Alert::success('Success','Product Checkout Successfully');
       return to_route('User#Success');
    }

    public function Success(){
        return view('user.success');
    }

    private function validatePayment($request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'paymentMethod' => 'required',

        ]);
    }

    private function paymentData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'payment_method' => $request->paymentMethod,
            'transaction_id' => $request->transactionId,
            'order_code' => $request->orderCode,
            'total_amt' => $request->totalAmount
        ];
    }

}
