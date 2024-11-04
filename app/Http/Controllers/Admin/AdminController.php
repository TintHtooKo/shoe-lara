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
        $admin = User::where('role','admin')->get();
        return view('admin.adminList.adminList',compact('admin'));
    }

    public function UserList(){
        $user = User::where('role','user')->get();
        return view('admin.userList.userList',compact('user'));
    }
}
