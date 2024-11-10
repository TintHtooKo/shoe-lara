@extends('user.layout.master')
@section('content')
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Checkout</h1>
                <nav class="d-flex align-items-center">
                    <a href="{{route('User#Home')}}">Home<span class="lnr lnr-arrow-right"></span></a>
                    <a href="">Checkout</a>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->

<!--================Checkout Area =================-->
<section class="checkout_area section_gap">
    <div class="container">

        <div class="billing_details">
            <form  action="{{route('User#Checkout')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-8">
                        <h3>Billing Details</h3>
                        <div class="row contact_form">
                           
                            <div class="col-md-6 form-group p_star">
                                <input type="text" value="{{Auth::user()->name}}" readonly class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Full Name">
                                @error('name')
                                    <span class="invalid-feedback">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="email" value="{{Auth::user()->email}}" readonly class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email">
                                @error('email')
                                <span class="invalid-feedback">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="number" value="{{old('phone')}}" class="form-control @error('phone') is-invalid @enderror"  name="phone" placeholder="Phone Number">
                                @error('phone')
                                <span class="invalid-feedback">{{$message}}</span>
                                @enderror
                            </div>
    
                            <div class="col-md-12 form-group p_star">
                                <input type="text" value="{{old('address')}}" class="form-control @error('address') is-invalid @enderror"  name="address" placeholder="Address">
                                @error('address')
                                <span class="invalid-feedback">{{$message}}</span>
                                @enderror
                            </div>
    
                            <div class="col-md-12 form-group p_star">
                                <select class="country_select @error('paymentMethod') is-invalid @enderror" id="paymentMethod" name="paymentMethod">
                                    <option>Select Payment Method</option>
                                    <option value="kpay">KBZ Pay</option>
                                    <option value="wavepay">Wave Pay</option>
                                    <option value="creditCard" disabled>Credit / Debit Card (Comming Soon)</option>
                                </select>
                                @error('paymentMethod')
                                <span class="invalid-feedback">{{$message}}</span>
                                @enderror
                            </div>
    
                            <div class="col-md-12 form-group payment-input" id="sharedPaymentInput" style="display: none;">
                                <div class="d-flex flex-row align-items-center justify-content-between">
                                    <div class="">
                                        <label for="paySlip">Payment Slip</label>
                                        <input type="file" required onchange="loadFile(event)" class="form-control mb-2" name="paySlip">
                                        <img id="output" src="{{ asset('admin/images/no_uploaded.png') }}" width="100" height="150" alt="">
                                        <input type="number" required class="form-control" name="transactionId" placeholder="The last 6 digits of transaction number">
                                    </div>
                                    <div class="d-flex flex-column align-items-center justify-content-center">
                                        <img id="paymentLogo" class="mb-2" width="100" height="100" alt="Payment Logo">
                                        <span class="mb-2">OR</span>
                                        <p>09123123123</p>
                                    </div>
                                </div>
                            </div>
            
                              
                            <input type="hidden" name="orderCode" value="{{$orderProduct[0]['order_code']}}">
                            <input type="hidden" name="totalAmount" value="{{$orderProduct[0]['total_amount']}}">
                            
                        </div>
                    </div>
                    
                    <div class="col-lg-4">
                        <div class="order_box">
                            <h2>Your Order</h2>
                            <ul class="list">
                                <li><a href="#">Product <span>Total</span></a></li>
                                @foreach ($orderProduct as $item)
                                <li><a href="#">{{$item['product_name']}} x {{$item['count']}}  <span class="last">{{$item['each_total']}} MMK</span></a></li>
                                @endforeach
                            </ul>
                            <ul class="list list_2">
                                <li><a href="#">Order Code <span>{{$orderProduct[0]['order_code']}}</span></a></li>
                                <li><a href="#">Subtotal <span>{{$orderProduct[0]['total_amount']}} MMK</span></a></li>
                                <li><a href="#">Shipping <span>Flat rate: 0</span></a></li>
                                <li><a href="#">Total <span>{{$orderProduct[0]['total_amount']}} MMK</span></a></li>
                            </ul>
    
                            <button type="submit" class="primary-btn border-0" >Proceed to Checkout </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!--================End Checkout Area =================-->
@endsection

@section('js-custom')
 <script>
     $(document).ready(function() {
    $('#paymentMethod').on('change', function() {
        // Hide the shared input field by default
        $('#sharedPaymentInput').hide();

        // Get the selected payment method
        const selectedMethod = $(this).val();
        
        // Set the appropriate image based on the payment method
        if (selectedMethod === 'kpay') {
            $('#sharedPaymentInput').show();
            $('#paymentLogo').attr('src', '{{ asset("user/kpay.webp") }}');
        } else if (selectedMethod === 'wavepay') {
            $('#sharedPaymentInput').show();
            $('#paymentLogo').attr('src', '{{ asset("user/wave.webp") }}');
        }
    });
});

 </script>
    
@endsection