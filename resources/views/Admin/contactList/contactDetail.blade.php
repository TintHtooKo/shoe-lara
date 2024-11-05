@extends('admin.layout.master')
@section('content')
<div class="container py-5">
    <div class="content-body">
        <div class="text-center mb-4">
            <h3 class="fw-bold">Contact Detail</h3>
        </div>
        <div class="card shadow-sm p-4">
            <div class="row mb-3">
                <div class="col-12 col-md-6 mb-2" style="color: black">
                    <strong>Full Name:</strong> <span style="color : #646464">{{$contact->name}}</span>
                </div>
                <div class="col-12 col-md-6 mb-2" style="color: black">
                    <strong>Email:</strong> <span style="color : #646464">{{$contact->email}}</span>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12 col-md-6 mb-2" style="color: black">
                    <strong>Subject:</strong> <span style="color : #646464">{{$contact->subject}}</span>
                </div>
                <div class="col-12 col-md-6 mb-2" style="color: black">
                    <strong>Message:</strong> <span style="color : #646464  ">{{$contact->message}}</span>
                </div>
            </div>
            <form action="{{route('Admin#contactIsReadChange', $contact->id)}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Make As Read</label>
                    <select name="check" class="form-control">
                        <option value="0" {{$contact->is_read ? '' : 'selected'}}>Still Doesn't Read</option>
                        <option value="1" {{$contact->is_read ? 'selected' : ''}}>Already Read</option>
                    </select>
                </div>
                <div class="mb-3">
                    <input type="submit" value="Change" class="btn btn-primary w-100 rounded shadow-sm">
                </div>
            </form>
        </div>
    </div>
</div>

@endsection