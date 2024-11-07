@extends('user.layout.master')
@section('content')

    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Shopping Cart</h1>
                    <nav class="d-flex align-items-center">
                        <a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="category.html">Cart</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!--================Cart Area =================-->
    <section class="cart_area">
        <div class="container">
            <div class="cart_inner">
                <div class="table-responsive">
                    <table class="table" id="productTable">
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($cart->count() > 0)
                                @foreach ($cart as $item)
                                <tr>
                                    <td>
                                        <div class="media">
                                            <div class="d-flex">
                                                <img src="{{asset('product/'.$item->image)}}" style="width: 100px;" alt="">
                                            </div>
                                            <div class="media-body">
                                                <p>{{$item->name}}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <h5 class="price">{{$item->new_price}} AED</h5>
                                    </td>
                                    <td>
                                        <div class="product_count">
                                            <input type="text" name="qty" id="sst{{ $item->id }}" maxlength="12" value="{{ $item->qty }}" title="Quantity:" class="input-text qty">
                    
                                            <button 
                                            onclick="var qtyInput = document.getElementById('sst{{ $item->id }}'); 
                                                     var qty = parseInt(qtyInput.value); 
                                                     if (!isNaN(qty)) qtyInput.value = qty + 1; 
                                                     document.getElementById('total{{ $item->id }}').innerText = ((qty + 1) * {{ $item->new_price }}) + ' AED'; 
                                                     return false;" 
                                            class="increase items-count plus" type="button">
                                            <i class="lnr lnr-chevron-up"></i>
                                            </button>
                                            
                                            <!-- Decrease button with inline JavaScript -->
                                            <button 
                                                onclick="var qtyInput = document.getElementById('sst{{ $item->id }}'); 
                                                        var qty = parseInt(qtyInput.value); 
                                                        if (!isNaN(qty) && qty > 1) qtyInput.value = qty - 1; 
                                                        document.getElementById('total{{ $item->id }}').innerText = ((qty - 1) * {{ $item->new_price }}) + ' AED'; 
                                                        return false;" 
                                                class="reduced items-count minus" type="button">
                                                <i class="lnr lnr-chevron-down"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td class="total">{{$item->new_price * $item->qty}} AED</td>
                                    <td>
                                        <button class="btn btn-danger py-2" style="border-radius: 60%">
                                            <i class="fa-solid fa-circle-xmark"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="text-center text-muted h4">There is not cart item</td>
                                </tr>
                            @endif

                        </tbody>
                    </table>
                    <hr>

                    <div class=" d-flex justify-content-between">
                        <div class=""></div>
                        <div class="cupon_text d-flex align-items-center">
                            <input type="text" class="form-control mx-2 " placeholder="Coupon Code">
                            <input type="submit" value="Apply" class="btn " style="background: #FFA100; color: white">
                        </div>
                    </div>

                    <hr>
                    
                    <div class=" d-flex justify-content-between">
                        <div class=""></div>
                        <div class="cupon_text d-flex align-items-center">
                            <h5>Sub Total: <span style="color: gray" id="subtotal">{{$total}} AED</span></h5>
                        </div>
                    </div>    
                    
                    <hr>

                    <div class=" d-flex justify-content-between">
                        <div class=""></div>
                        <div class="checkout_btn_inner d-flex align-items-center">
                            <a class="gray_btn" href="{{route('User#Shop')}}">Continue Shopping</a>
                            <a class="btn" style="background: #FFA100; color: white" href="#">Proceed to checkout</a>
                        </div>
                    </div>  

                </div>
            </div>
        </div>
    </section>
    <!--================End Cart Area =================-->
@endsection

@section('js-custom')
    <script>
        $(document).ready(function() {
            // plus click
            $('.plus').click(function(){
                $parentNode = $(this).parents("tr");
                $price = $parentNode.find(".price").text().replace("AED","");
                // input box ka moh val nae data phan tr
                $qty = $parentNode.find(".qty").val()
                $totalAmt = $price * $qty
                $parentNode.find(".total").text($totalAmt + " AED");
                finalCalculation()
            })

            // minus click
            $('.minus').click(function(){
                $parentNode = $(this).parents("tr");
                $price = $parentNode.find(".price").text().replace("AED","");
                // input box ka moh val nae data phan tr
                $qty = $parentNode.find(".qty").val()
                $totalAmt = $price * $qty
                $parentNode.find(".total").text($totalAmt + " AED");
                finalCalculation()
            })

            function finalCalculation(){
                $total = 0
                $('#productTable tbody tr').each(function(index,item){
                   $total += Number($(item).find('.total').text().replace('AED',''))                  
                })
                $('#subtotal').html(`${$total} AED`)

            }
        
    })
    </script>
@endsection