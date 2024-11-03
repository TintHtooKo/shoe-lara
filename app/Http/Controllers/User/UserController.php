<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function UserHome(){
        return view('user.dashboard');
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
