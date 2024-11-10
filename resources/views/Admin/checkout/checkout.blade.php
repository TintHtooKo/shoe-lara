@extends('admin.layout.master')
@section('content')
<div class=" content-body">
    <div class="text-center my-4">
        <h2>Checkout List</h2>
    </div>
    <div class="row justify-content-between align-items-center my-3 mx-1">

        <div class="col-12 col-md-6">
            <form action="" method="GET">
                @csrf
                <div class="input-group">
                    <input type="text" value="{{request('search')}}" name="search" class="form-control mx-2" placeholder="Search">
                    <button type="submit" class="btn bg-dark text-white"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </form>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-bordered table-dark text-center">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Order Code</th>
                    <th scope="col">Payment Method</th>
                    <th scope="col">Total Price</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @if ($payment->count() != 0)
                @foreach ($payment as $item)
                <tr>
                    <td>{{ ($payment->currentPage() - 1) * $payment->perPage() + $loop->iteration }}</td>
                    <td class="col-1">
                        {{$item->name}}
                    </td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->order_code}} </td>
                    <td>{{ $item->payment_method}}</td>
                    <td>{{ $item->total_amt}} MMK</td>
                   
                    <td>
                        <div class=" d-flex align-items-center justify-content-center ">
                            <a href="{{route('Admin#checkoutDetail',$item->id)}}" class="btn btn-sm btn-warning cursor-pointer mx-2"><i class="fa-solid fa-eye "></i></a>
                            @if (Auth::user()->role == 'superadmin')
                            <a href="{{route('Admin#paymentDelete',$item->id)}}" class="btn btn-sm btn-danger cursor-pointer"><i class="fa-solid fa-trash"></i></a>
                            @endif
                        </div>
                    </td>
                    
                </tr>
                @endforeach
                @else
                    <tr>
                        <td colspan="5">There is no checkout List</td>
                    </tr>
                @endif
            </tbody>
        </table>
        <span class="d-flex justify-content-end">{{ $payment->links() }}</span>
    </div>
</div>
@endsection