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

<div class="container">
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
                <div class="">
                    <a href="{{route('User#profileUpdatePage')}}" class="btn btn-primary mt-3">Change Profile</a>
                    <a href="{{route('User#changePasswordPage')}}" class="btn btn-warning text-white mt-3">Change Password</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="table-responsive mt-5">
    <table class="table table-bordered table-dark text-center">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Image</th>
                <th scope="col">Product Name</th>
                <th scope="col">Qty</th>
                <th scope="col">Order Code</th>
                <th scope="col">Status</th>
                <th scope="col">Order Date</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @if ($order)
            @foreach ($order as $item)
            <tr>
                <td>{{ ($order->currentPage() - 1) * $order->perPage() + $loop->iteration }}</td>
                <td class="col-1">
                    <img src="{{asset('product/'.$item->product_image)}}" class="img-thumbnail shadow-sm rounded" width="50" alt="">
                </td>
                <td>{{ $item->product_name }}</td>
                <td>{{ $item->count }}</td>
                <td>{{ $item->order_code}}</td>
                <td>  
                    @if($item->status == 0)
                    <span class=" text-warning">Pending</span>                   
                    @elseif ($item->status == 1)
                     <span class=" text-primary">Delivery is on the way</span>
                    @elseif ($item->status == 2)
                    <span class=" text-success">Received</span>
                    @elseif ($item->status == 3)
                    <span class=" text-danger">Rejected</span>
                    @endif
                </td>
                <td>{{ $item->created_at->format('M d, Y h:i A') }}</td>
            </tr>
            @endforeach
            @else
                <tr>
                    <td colspan="5">There is no checkout List</td>
                </tr>
            @endif
        </tbody>
    </table>
    <span class="d-flex justify-content-end">{{ $order->links() }}</span>
</div>
<div class="container d-flex justify-content-end my-5">
    <div class="">
        @if ($payment)
        <h4>Payment Method - <span class="text-muted">{{ $payment->payment_method }}</span></h4>
        <h4>Total Amount - <span class="text-muted">{{ $payment->total_amt }} MMK</span></h4>
        @endif
    </div>
</div>
@endsection