@extends('admin.layout.master')
@section('content')
    <div class="content-body">
        <div class="text-center my-4">
            <h2 class="fw-bold">Profile</h2>
        </div>
        <div class=" d-flex justify-content-center align-items-center mt-5">
            <div class=" d-flex flex-wrap">
                <div class=" mx-5">
                    @if (Auth::user()->image)
                    <img src="{{asset('/profile/'.Auth::user()->image)}}" class="img-thumbnail" width="200" alt="">
                    @else
                    <img src="{{asset('admin/images/demo.png')}}" class="img-thumbnail" alt="">
                    @endif
                </div>
                <div class=" mx-5">
                    <h4>Name - <span class="text-muted">{{ Auth::user()->name }}</span></h4>
                    <h4>Email - <span class="text-muted">{{ Auth::user()->email }}</span></h4>
                    <h4>Phone - <span class="text-muted">{{ Auth::user()->phone ? Auth::user()->phone : 'N/A' }}</span></h4>
                    <h4>Address - <span class="text-muted">{{ Auth::user()->address ? Auth::user()->address : 'N/A' }}</span></h4>
                    <a href="{{route('Admin#changeProfilePage')}}" class="btn btn-primary mt-3">Change Profile</a>
                </div>
            </div>
        </div>
    </div>
@endsection