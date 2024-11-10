@extends('user.layout.master')
@section('content')
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Profile</h1>
                <nav class="d-flex align-items-center">
                    <a href="{{route('User#Home')}}">Home<span class="lnr lnr-arrow-right"></span></a>
                    <a href="#">Profile</a>
                </nav>
            </div>
        </div>
    </div>
</section>
<div class="container mt-5">
    <div class="text-center my-4">
        <h2>Profile Update</h2>
    </div>
    <div class="d-flex justify-content-center my-5">
        <div class="card shadow-sm p-4 w-100" style="max-width: 400px;">
            <form action="{{route('User#profileUpdate')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" readonly value="{{Auth::user()->email}}" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                    @error('email')
                        <span class="invalid-feedback">{{$message}}</span>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" value="{{Auth::user()->name}}" id="username" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="User Name">
                    @error('username')
                        <span class="invalid-feedback">{{$message}}</span>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" value="{{Auth::user()->address}}" id="address" name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Address">
                    @error('address')
                        <span class="invalid-feedback">{{$message}}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="number" value="{{Auth::user()->phone}}" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Phone">
                    @error('phone')
                        <span class="invalid-feedback">{{$message}}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="image" class="form-label">Profile Image</label>
                    <input type="file" onchange="loadFile(event)" id="image" name="image" class="form-control @error('image') is-invalid @enderror" placeholder="Confirm new password">
                    <img id="output" src="{{asset(Auth::user()->image == null ? 'admin/images/no_uploaded.png' : 'profile/'.Auth::user()->image)}}" class="img-profile img-thumbnail" alt="">
                    @error('image')
                        <span class="invalid-feedback">{{$message}}</span>
                    @enderror

                </div>
                
                <div class="d-grid">
                    <input type="submit" value="Change Profile" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection