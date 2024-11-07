@extends('user.layout.master')
@section('content')
    	<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Shop Category page</h1>
					<nav class="d-flex align-items-center">
						<a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
						<a href="#">Shop<span class="lnr lnr-arrow-right"></span></a>
						<a href="category.html">Fashon Category</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->
	<div class="container">
		<div class="row">
			<div class="col-xl-3 col-lg-4 col-md-5">
				<div class="sidebar-categories">
					<div class="head">Shoe Types</div>
					<ul class="main-categories">
						<li class="main-nav-list">
							<a href="{{url('user/shop')}}" class="@if(!request('typeId')) text-warning @endif">
								All types
							</a>
						</li>
						@foreach ($type as $item)
						<li class="main-nav-list">
							<a href="{{url('user/shop?typeId='.$item->id)}}" class="@if(request('typeId') == $item->id) text-warning @endif">
								{{$item->type}}
							</a>
						</li>
						@endforeach
					</ul>
				</div>
				<div class="sidebar-filter mt-50">
					<div class="top-filter-head">Product Filters</div>

					<div class="common-filter">
						<div class="head">Price</div>
						<form action="{{ route('User#Shop') }}" method="get" >
							@csrf
							<div class="d-flex flex-column flex-md-row gap-3">
								<div class="form-group flex-fill">
									<label for="minPrice" class="form-label">Min Price</label>
									<input type="text" id="minPrice" value="{{ request('minPrice') }}" name="minPrice" class="form-control" placeholder="Min Price">
								</div>

								<div class="">
									<span>&nbsp;</span>
								</div>
								
								<div class="form-group flex-fill">
									<label for="maxPrice" class="form-label">Max Price</label>
									<input type="text" id="maxPrice" value="{{ request('maxPrice') }}" name="maxPrice" class="form-control" placeholder="Max Price">
								</div>
							</div>
							
							<input type="submit" value="Filter" class="btn text-white mt-2 w-100" style=" background-color: #FF9600">	
						</form>					
					</div>

				</div>
			</div>
			<div class="col-xl-9 col-lg-8 col-md-7">
				<!-- Start Filter Bar -->

				<!-- End Filter Bar -->
				<!-- Start Best Seller -->
				<div class="filter-bar d-flex flex-wrap align-items-center">
					<div class="sorting mr-auto">
					</div>
					<form action="{{route('User#Shop')}}" method="get">
						@csrf
						<div class=" d-flex mt-2">
							<input type="text" name="search" value="{{request('search')}}" class="form-control mx-2" placeholder=" Search ...">
							<button type="submit" class="btn text-white border-none"><i class="fa fa-search"></i></button>
						</div>
					</form>
				</div>
				<section class="lattest-product-area pb-40 category-list">
					<div class="row">
						<!-- single product -->
						@foreach ($product as $item)
						<div class="col-lg-4 col-md-6">
							<div class="single-product">
								<img class="img-fluid" src="{{asset('/product/'.$item->image)}}" alt="">
								<div class="product-details">
									<h6>{{$item->name}}
										@if ($item->stock == 0)
											<span class="bg-danger text-white rounded p-1" style="font-size: 12px">Out of Stock</span>
										@endif
									</h6>
									<div class="price">
										<h6>{{$item->new_price}} AED</h6>
										@if ($item->old_price)
										<h6 class="l-through">{{$item->old_price}} AED</h6>
										@endif
									</div>
									<div class="prd-bottom">
										<div class="d-flex align-items-center ">
											<form action="{{route('User#CartAdd')}}" method="post">
												@csrf
												<input type="hidden" name="productId" value="{{$item->id}}">
												<input type="hidden" name="userId" @if(Auth::user() != null) value="{{Auth::user()->id}}" @endif">
												<input type="hidden" name="count" value="1">
												<button type="submit" class="border-0" style="background: transparent">
													<div class="px-2 py-1 hover-bg" style=" background: #828bb3; border-radius:50%; cursor:pointer;">
														<span class="ti-bag" style=" color:white"></span>
													</div>
												</button>
											</form>
											<a href="{{route('User#productDetail',$item->id)}}" class="social-info">
												<span class="lnr lnr-move"></span>
												<p class="hover-text">view more</p>
											</a>
										</div>
										
									</div>
								</div>
							</div>
						</div>
						@endforeach
					
					</div>
				</section>
				<!-- End Best Seller -->
				<!-- Start Filter Bar -->
				<div class="filter-bar d-flex flex-wrap align-items-center">
					<div class="sorting mr-auto">
					</div>
					<div class="">
						{{ $product->links('pagination.custom') }}
					</div>
				</div>
				<!-- End Filter Bar -->
			</div>
		</div>
	</div>

	<!-- Start related-product Area -->

	<!-- End related-product Area -->
@endsection