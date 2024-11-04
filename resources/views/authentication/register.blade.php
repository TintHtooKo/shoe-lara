@extends('user.layout.master')
@section('content')
    	<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Login/Register</h1>
					<nav class="d-flex align-items-center">
						<a href="{{route('User#Home')}}">Home<span class="lnr lnr-arrow-right"></span></a>
						<a href="category.html">Login/Register</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->

	<!--================Login Box Area =================-->
	<section class="login_box_area section_gap">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="login_box_img">
						<img class="img-fluid" src="{{asset('user/img/login.jpg')}}" alt="">
						<div class="hover">
							<h4>Already register to our website?</h4>
							<p>There are advances being made in science and technology everyday, and a good example of this is the</p>
							<a class="primary-btn" href="{{route('login')}}">Login</a>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="login_form_inner">
						<h3>Register in to enter</h3>
						<form class="row login_form" action="{{route('register')}}" method="POST" id="contactForm" novalidate="novalidate">
                            @csrf
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" value="{{old('name')}}" id="name" name="name" placeholder="Username" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Username'">
                                @error('name')
									<span class="text-danger">{{$message}}</span>
								@enderror
							</div>
                            <div class="col-md-12 form-group">
								<input type="email" class="form-control" id="email" value="{{old('email')}}" name="email" placeholder="Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'">
                                @error('email')
									<span class="text-danger">{{$message}}</span>
								@enderror
							</div>
							<div class="col-md-12 form-group">
								<input type="password" class="form-control" id="password" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'">
                                @error('password')
									<span class="text-danger">{{$message}}</span>
								@enderror
							</div>
                            <div class="col-md-12 form-group">
								<input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Confirm Password'">
                                @error('password_confirmation')
									<span class="text-danger">{{$message}}</span>
								@enderror
							</div>
							<div class="col-md-12 form-group">
								<button type="submit" value="submit" class="primary-btn">Register</button>
							</div>
							<hr>
							<div class="col-md-12">
								<div class="d-flex align-items-center justify-content-center gap-3">
									<a href="#" class="mx-3">
										<img src="{{asset('user/img/svg/google.svg')}}" style="width:50px" alt="Google logo" class="mx-1">
									</a>
									<a href="#" class="">
										<img src="{{asset('user/img/svg/facebook.svg')}}" style="width:60px" alt="Facebook logo" class="mx-1">
									</a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Login Box Area =================-->
@endsection