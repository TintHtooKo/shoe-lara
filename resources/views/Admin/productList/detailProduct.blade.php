@extends('admin.layout.master')
@section('content')
<div class="content-body">
    <!-- Top Navigation Links -->
    <div class="d-flex align-items-center justify-content-between mb-4 mx-3">
        <a href="{{route('Admin#productList')}}" class="text-dark" style="font-size: 1.5rem;">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <a href="{{route('Admin#editProductPage',$product->id)}}" class="btn btn-primary">
            Edit
        </a>
    </div>

    <!-- Shoe Detail Title -->
    <div class="text-center mb-5">
        <h2>Shoe Detail</h2>
    </div>

    <!-- Shoe Details -->
    <div class="row">
        <!-- Image Section -->
        <div class="col-md-4 text-center mb-4 mb-md-0">
            <img src="{{asset('product/'.$product->image)}}" class="img-fluid rounded shadow-sm" alt="Shoe Image">
        </div>

        <!-- Details Section -->
        <div class="col-md-8">
            <div class="mb-3">
                <h5>Name</h5>
                <p class="text-muted">{{$product->name}}</p>
            </div>
            <div class="mb-3">
                <h5>Short Description</h5>
                <p class="text-muted">{{$product->short_desc}}</p>
            </div>
            <div class="mb-3">
                <h5>Long Description</h5>
                <p class="text-muted">{{$product->long_desc}}</p>
            </div>
            <div class="mb-3">
                <h5>Old Price</h5>
                <p class="text-muted">
                    @if ($product->old_price != null)
                        {{$product->old_price}}
                    @else
                        <span>-</span>
                    @endif
                </p>
            </div>
            <div class="mb-3">
                <h5>New Price</h5>
                <p class="text-muted">{{$product->new_price}}</p>
            </div>
            <div class="mb-3">
                <h5>Stock</h5>
                <p class="text-muted">{{$product->stock}}</p>
            </div>
            <div class="mb-3">
                <h5>Shoe Type</h5>
                <p class="text-muted">{{$product->type}}</p>
            </div>
        </div>
    </div>
</div>

@endsection