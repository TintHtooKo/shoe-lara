<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller;
use App\Models\Contact;
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
        return view('admin.checkout.checkout');
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
