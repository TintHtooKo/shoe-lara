<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class CommentController extends Controller
{
    public function comment(Request $request){
        $this->validateComment($request);
        Comment::create([
            'product_id' => $request->productId,
            'user_id' => Auth::user()->id,
            'message' => $request->comment
        ]);
        Alert::success('Success', 'Comment Added Successfully');
        return back();
    }

    public function deleteComment($id){
        Comment::find($id)->delete();
        Alert::success('Success','Comment Deleted Successfully');
        return back();
    }

    private function validateComment($request){
        $request->validate([
            'comment' => 'required'
        ]);
    }
    
}
