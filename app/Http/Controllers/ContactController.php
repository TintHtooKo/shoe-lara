<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ContactController extends Controller
{
    public function contentSend(Request $request){
        $this->validateContact($request);
        $data = $this->contactDate($request);
        Contact::create($data);
        Alert::success('Success', 'Your message has been sent successfully');
        return back();
    }

    public function contactDetail($id){
        $contact = Contact::find($id);
        return view('admin.contactList.contactDetail', compact('contact'));
    }

    public function contactIsReadChange(Request $request, $id){
        $data = Contact::find($id);
        $data->is_read = $request->check;
        $data->save();
        Alert::success('Success', 'Message status changed successfully');
        return to_route('Admin#contact');
    }

    public function contactDelete($id){
        Contact::find($id)->delete();
        Alert::success('Success', 'Message deleted successfully');
        return back();
    }

    private function validateContact($request){
        return $request->validate([
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required'
        ]);
    }

    private function contactDate($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ];
    }
}
