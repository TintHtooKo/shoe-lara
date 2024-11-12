<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{ 
    public function profilePage() {
        // Retrieve paginated orders if there are any orders for the user
        $order = Order::select('orders.id', 'orders.order_code', 'orders.status', 'orders.product_id', 'orders.created_at', 'orders.count',
                                'products.name as product_name', 'products.image as product_image', 'products.new_price as product_price')
                      ->leftJoin('products', 'orders.product_id', 'products.id')
                      ->where('user_id', Auth::user()->id)
                      ->paginate(5);
    
        // Check if there are any orders and retrieve the first order code if available
        $firstOrder = Order::where('user_id', Auth::user()->id)->first();
        $payment = $firstOrder ? Payment::select('payments.total_amt', 'payments.payment_method')
                                         ->where('order_code', $firstOrder->order_code)
                                         ->first()
                               : null;
    
        return view('user.profile', compact('order', 'payment'));
    }
    

    public function profileUpdatePage(){
        return view('user.profileUpdate');
    }

    public function profileUpdate(Request $request){
        $this->validateProfile($request);
        $data = $this->requestProfileData($request);
        if($request->hasFile('image')){
            if(Auth::user()->image != null){
                if(file_exists(public_path().'/profile/'.Auth::user()->image)){
                    unlink(public_path().'/profile/'.Auth::user()->image);
                }
            }
            $fileName = uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path().'/profile/',$fileName);
            $data['image'] = $fileName;
        }else{
            $data['image'] = Auth::user()->image;
        }

        User::where('id',Auth::user()->id)->update($data);
        Alert::success('Success', 'Profile Updated Successfully');
        return to_route('User#profile');
        
    }

    public function changePasswordPage(){
        return view('user.changePassword');
    }

    public function changePassword(Request $request){
        $this->validatePassword($request);
        $currentPassword = Auth::user()->password;
        if(Hash::check($request->oldPassword,$currentPassword)){
            User::where('id',Auth::user()->id)->update([
               'password' => Hash::make($request->newPassword) 
            ]);
            Alert::success('Success', 'Password Changed Successfully');
            return to_route('User#profile');
        }else{
            Alert::error('Error', 'Old password does not match');
            return back();  
        }
    }

    private function validateProfile($request){
        $request->validate([
            'username' => 'required',
            'phone' => [
            'nullable',
            Rule::unique('users', 'phone')->ignore(Auth::id()),
        ],
        ]);
    }

    private function validatePassword($request){
        $request->validate([
           'oldPassword' => 'required',
           'newPassword' => 'required|min:5',
           'confirmPassword' => 'required|same:newPassword|min:5',
        ]);
    }

    private function requestProfileData($request){
        return [
            'name' => $request->username,
            'phone' => $request->phone,
            'address' => $request->address
        ];
    }
}
