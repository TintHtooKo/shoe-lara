@extends('user.layout.master')
@section('content')


	<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Contact Us</h1>
					<nav class="d-flex align-items-center">
						<a href="{{route('User#Home')}}">Home<span class="lnr lnr-arrow-right"></span></a>
						<a href="#">Contact</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->

	<!--================Contact Area =================-->
	<section class="contact_area section_gap_bottom">
		<div class="container">
			<div class="row">
				<div class="col-lg-3">
					<div class="contact_info">
						<div class="info_item">
							<i class="lnr lnr-home"></i>
							<h6>California, United States</h6>
							<p>Santa monica bullevard</p>
						</div>
						<div class="info_item">
							<i class="lnr lnr-phone-handset"></i>
							<h6><a href="#">00 (440) 9865 562</a></h6>
							<p>Mon to Fri 9am to 6 pm</p>
						</div>
						<div class="info_item">
							<i class="lnr lnr-envelope"></i>
							<h6><a href="#">example@yourdomain.com</a></h6>
							<p>Send us your query anytime!</p>
						</div>
					</div>
				</div>
				<div class="col-lg-9">
					<form class="row contact_form" action="{{route('User#ContactSend')}}" method="post" id="contactForm" novalidate="novalidate">
						@csrf
						<div class="col-md-6">
							<div class="form-group">
								<input type="text" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter your name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'">
								@error('name')
									<span class="invalid-feedback">{{$message}}</span>
								@enderror
							</div>
							<div class="form-group">
								<input type="email" value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter email address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'">
								@error('email')
									<span class="invalid-feedback">{{$message}}</span>
								@enderror
							</div>
							<div class="form-group">
								<input type="text" value="{{old('subject')}}" class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" placeholder="Enter Subject" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Subject'">
								@error('subject')
									<span class="invalid-feedback">{{$message}}</span>
								@enderror
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group"> 
								<textarea class="form-control @error('message') is-invalid @enderror" value="{{old('message')}}" name="message" id="message" rows="1" placeholder="Enter Message" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Message'"></textarea>
								@error('message')
									<span class="invalid-feedback">{{$message}}</span>
								@enderror
							</div>
						</div>
						<div class="col-md-12 text-right">
							<button type="submit" value="submit" class="primary-btn">Send Message</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
	<!--================Contact Area =================-->
@endsection