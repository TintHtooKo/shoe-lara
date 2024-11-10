<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Order;
use App\Models\Payment;
use App\Models\ShoeType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    public function AdminHome(){
        return view('admin.dashboard');
    }

    public function AdminList(){
        $admin = User::select('id','name','email','role','address','phone','provider')
                    ->where('role','admin')
                    ->when(request('search'),function($query){
                        $query->whereAny(['name','email','address','phone','provider'],
                    'like','%'.request('search').'%');
                    })
                    ->orderBy('id','desc')
                    ->paginate(4);
        return view('admin.adminList.adminList',compact('admin'));
    }

    public function UserList(){
        $user = User::select('id','name','email','role','address','phone','provider')
                ->where('role','user')
                ->when(request('search'),function($query){
                    $query->whereAny(['name','email','address','phone','provider'],
                'like','%'.request('search').'%');
                })
                ->orderBy('id','desc')
                ->paginate(4);
        return view('admin.userList.userList',compact('user'));
    }

    public function addAdminPage(){
        return view('admin.adminList.adminAdd');
    }

    public function addAdmin(Request $request){
        $this->validateAddAdmin($request);
        $data = $this->addAdminData($request);
        User::create($data);
        Alert::success('Success', 'New Admin Added Successfully');
        return to_route('Admin#AdminList');
    }

    public function deleteAdmin($id){
        User::find($id)->delete();
        Alert::success('Success', 'Admin Account Deleted Successfully');
        return back();
    }

    public function deleteUser($id){
        User::find($id)->delete();
        Alert::success('Success', 'User Account Deleted Successfully');
        return back();
    }

    public function shoeTypesPage(){
        $type = ShoeType::select('id','type')->paginate(4);
        return view('admin.shoeTypes.shoeTypes',compact('type'));
    }

    public function contactPage(){
        $contact = Contact::orderBy('id','desc')
                        ->paginate(4);
        return view('admin.contactList.contactList',compact('contact'));
    }

    public function checkout(){
        $payment = Payment::select('payments.id','payments.name','payments.email','payments.payment_method',
                                    'payments.order_code','payments.created_at','payments.total_amt','payments.payslip_img')
                            ->orderBy('created_at','desc')->paginate(5);
        return view('admin.checkout.checkout',compact('payment'));
    }

    public function checkoutDetail($id){
        $payment = Payment::find($id);
        $order = Order::select('orders.id','orders.status','orders.order_code','orders.count','orders.product_id','products.name as product_name','products.image as product_img')
                        ->leftJoin('products','orders.product_id','products.id')
                        ->where('order_code',$payment->order_code)->paginate(6);
        return view('admin.checkout.checkoutDetail',compact('payment','order'));
    }

    public function statusChange(Request $request,$id){
        $payment = Payment::find($id);
        $order = Order::where('order_code',$payment->order_code)->get();
        foreach($order as $item){
            $item->update([
                'status' => $request['status']
            ]);
        }
        Alert::success('Success', 'Status Changed Successfully');
        return back();
    }

    public function paymentDelete($id){
        $payment = Payment::find($id);
        if ($payment) {
            $payslipPath = public_path('/payslip/' . $payment->payslip_img);
            if (file_exists($payslipPath)) {
                unlink($payslipPath);
            }
            $payment->delete();
        }
        Order::where('order_code', $payment->order_code)->delete();
        Alert::success('Success', 'Payment Deleted Successfully');
        return back();
    }


    // for add admin
    private function validateAddAdmin($request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,',
            'password' => 'required',
        ],[
            'email.unique' => 'Email is already used'
        ]);
    }

    private function addAdminData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin'
        ];
    }


}
