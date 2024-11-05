@extends('admin.layout.master')
@section('content')
<div class="content-body">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="card-title text-center mb-4">Add New Admin</h3>
                    <form action="{{route('Admin#addAdmin')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Full Name">
                            @error('name')
                                <span class="invalid-feedback">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email">
                            @error('email')
                                <span class="invalid-feedback">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password">
                            @error('password')
                                <span class="invalid-feedback">{{$message}}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection