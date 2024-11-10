@extends('admin.layout.master')
@section('content')
<div class="content-body">
    <div class="text-center my-4">
        <h2>Checkout Detail</h2>
    </div>
    <div class="d-flex align-items-center justify-content-between mb-4 mx-3">
        <a href="{{route('Admin#checkout')}}" class="text-dark" style="font-size: 1.5rem;">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <a href="#" >
            
        </a>
    </div>
    <div class="my-5 d-flex flex-wrap justify-content-around">
        <div class="">
            <img src="{{ asset('/payslip/' . $payment->payslip_img) }}" width="200" alt="Payslip Image">
        </div>
        <div class="">
            <h4 class="text-dark">Name - <span class="text-muted">{{ $payment->name }}</span></h4>
            <h4 class="text-dark">Email - <span class="text-muted">{{ $payment->email }}</span></h4>
            <h4 class="text-dark">Phone - <span class="text-muted">{{ $payment->phone }}</span></h4>
            <h4 class="text-dark">Address - <span class="text-muted">{{ $payment->address }}</span></h4>
            <h4 class="text-dark">Payment Method - <span class="text-muted">{{ $payment->payment_method }}</span></h4>
            <h4 class="text-dark">Order Code - <span class="text-muted">{{ $payment->order_code }}</span></h4>
            <h4 class="text-dark">Transaction Id - <span class="text-muted">{{ $payment->transaction_id }}</span></h4>
            <h4 class="text-dark">Total Amount - <span class="text-muted">{{ $payment->total_amt }} MMK</span></h4>
            <h4 class="text-dark">Payment Status - 
                <span class="text-muted">
                    @if ($order->first()->status == 0)
                            <span class="text-warning">Pending</span>
                    @elseif($order->first()->status == 1)
                        <span style="color: skyblue">Delivery is on the way</span>
                    @elseif($order->first()->status == 2)
                        <span class="text-success">Received</span>
                    @else
                        <span class="text-danger">Rejected</span>
                    @endif
                </span>
            </h4>

            <form action="{{route('Admin#statusChange',$payment->id)}}" method="post" class="mt-5" id="statusForm">
                @csrf
                <select name="status" class="form-control">
                    <option value="0" @if($order->first()->status == 0) selected @endif>Pending</option>
                    <option value="1" @if($order->first()->status == 1) selected @endif>Delivery is on the way</option>
                    <option value="2" @if($order->first()->status == 2) selected @endif>Received</option>
                    <option value="3" @if($order->first()->status == 3) selected @endif>Rejected</option>
                </select>
                <input type="submit" value="Change Status" class="btn btn-primary text-white mt-3">
            </form>
        </div>
    </div>
    <div class="table-responsive mt-5">
        <table class="table table-hover table-bordered table-dark text-center">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Image</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Qty</th>
                </tr>
            </thead>
            <tbody>
                @if ($order->count() != 0)
                @foreach ($order as $item)
                <tr>
                    <td>{{ ($order->currentPage() - 1) * $order->perPage() + $loop->iteration }}</td>
                    <td class="col-1">
                        <img src="{{asset('product/'.$item->product_img)}}" class="img-thumbnail shadow-sm rounded w-100" alt="">
                    </td>
                    <td>{{ $item->product_name }}</td>
                    <td>  
                        {{ $item->count}}
                    </td>
                </tr>
                @endforeach
                @else
                    <tr>
                        <td colspan="5">There is no Shoe List</td>
                    </tr>
                @endif
            </tbody>
        </table>
        <span class="d-flex justify-content-end">{{ $order->links() }}</span>
    </div>
</div>

@endsection
