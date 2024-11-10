<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    public function changePasswordPage(){
        return view('admin.profile.changePassword');
    }

    public function changePassword(Request $request){
        $this->validatePassword($request);
        $currentPassword = Auth::user()->password;
        if(Hash::check($request->oldPassword,$currentPassword)){
            User::where('id',Auth::user()->id)->update([
               'password' => Hash::make($request->newPassword) 
            ]);
            Alert::success('Success', 'Password Changed Successfully');
            return back();
        }else{
            Alert::error('Error', 'Old password does not match');
            return back();  
        }
    }

    public function profilePage(){
        return view('admin.profile.profile');
    }

    public function changeProfilePage(){
        return view('admin.profile.changeProfile');
    }

    public function changeProfile(Request $request){
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
        return to_route('Admin#profile');
    }

    private function validatePassword($request){
        $request->validate([
           'oldPassword' => 'required',
           'newPassword' => 'required|min:5',
           'confirmPassword' => 'required|same:newPassword|min:5',
        ]);
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

    private function requestProfileData($request){
        return [
            'name' => $request->username,
            'phone' => $request->phone,
            'address' => $request->address
        ];
    }

}
