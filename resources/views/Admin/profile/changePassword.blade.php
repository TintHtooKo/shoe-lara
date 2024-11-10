@extends('admin.layout.master')
@section('content')
<div class="content-body">
    <div class="container">
        <div class="text-center my-4">
            <h2 class="fw-bold">Change Password</h2>
            <p class="text-muted">Ensure your account is secure by updating your password regularly.</p>
        </div>
        
        <div class="d-flex justify-content-center">
            <div class="card shadow-sm p-4 w-100" style="max-width: 400px;">
                <form action="{{route('Admin#changePassword')}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="oldPassword" class="form-label">Old Password</label>
                        <input type="password" id="oldPassword" name="oldPassword" class="form-control @error('oldPassword') is-invalid @enderror" placeholder="Enter old password">
                        @error('oldPassword')
                            <span class="invalid-feedback">{{$message}}</span>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="newPassword" class="form-label">New Password</label>
                        <input type="password" id="newPassword" name="newPassword" class="form-control @error('newPassword') is-invalid @enderror" placeholder="Enter new password">
                        @error('newPassword')
                            <span class="invalid-feedback">{{$message}}</span>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="confirmPassword" class="form-label">Confirm New Password</label>
                        <input type="password" id="confirmPassword" name="confirmPassword" class="form-control @error('confirmPassword') is-invalid @enderror" placeholder="Confirm new password">
                        @error('confirmPassword')
                            <span class="invalid-feedback">{{$message}}</span>
                        @enderror
                    </div>
                    
                    <div class="d-grid">
                        <input type="submit" value="Change Password" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection