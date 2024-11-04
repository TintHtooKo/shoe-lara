<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request; 

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
                    ->get();
        return view('admin.adminList.adminList',compact('admin'));
    }

    public function UserList(){
        $user = User::select('id','name','email','role','address','phone','provider')
                ->where('role','user')
                ->when(request('search'),function($query){
                    $query->whereAny(['name','email','address','phone','provider'],
                'like','%'.request('search').'%');
                })
                ->get();
        return view('admin.userList.userList',compact('user'));
    }
}
