<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class RatingController extends Controller
{
    public function rating(Request $request){
        // dd($request->all());
        Rating::updateOrCreate([
            'user_id'=>Auth::user()->id,
            'product_id'=>$request->productId,
        ],[
            'count'=>$request->rating
        ]);
        Alert::success('Success','Rating Added Successfully');
        return back();
    }
}
