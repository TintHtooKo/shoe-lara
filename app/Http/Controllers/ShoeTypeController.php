<?php

namespace App\Http\Controllers;

use App\Models\ShoeType;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ShoeTypeController extends Controller
{
    public function shoeTypeCreate(Request $request){
        $this->validateShoeType($request);
        $data = $this->TypeData($request);
        ShoeType::create($data);
        Alert::success('Success', 'Shoe Type Added Successfully');
        return back();
    }

    public function shoeTypeDelete($id){
        ShoeType::find($id)->delete();
        Alert::success('Success', 'Shoe Type Deleted Successfully');
        return back();
    }

    private function validateShoeType($request){
        $request->validate([
            'type' => 'required',
        ],[
            'type.required' => 'Need to enter Shop Type'
        ]);
    }

    private function TypeData($request){
        return [
            'type' => $request->type
        ];
    }
}
