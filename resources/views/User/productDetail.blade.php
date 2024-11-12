@extends('user.layout.master')
@section('content')
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Product Details Page</h1>
                <nav class="d-flex align-items-center">
                    <a href="{{route('User#Home')}}">Home<span class="lnr lnr-arrow-right"></span></a>
                    <a href="{{route('User#Shop')}}">Shop<span class="lnr lnr-arrow-right"></span></a>
                    <a href="#">product-details</a>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->

<!--================Single Product Area =================-->
<div class="product_image_area">
    <div class="container">
        <div class="row s_product_inner">
            <div class="col-lg-6">
                <div class="s_Product_carousel">
                    <div class="single-prd-item">
                        <img class="img-fluid" src="{{asset('product/'.$product->image)}}" alt="">
                    </div>
                    <div class="single-prd-item">
                        <img class="img-fluid" src="{{asset('product/'.$product->image)}}" alt="">
                    </div>
                    <div class="single-prd-item">
                        <img class="img-fluid" src="{{asset('product/'.$product->image)}}" alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-5 offset-lg-1">
                <div class="s_product_text">
                    <h3>{{$product->name}}</h3>
                    <h2>{{$product->new_price}}MMK</h2>
                    <ul class="list">
                        <li><a class="active" href="#"><span>Category</span> : {{$product->type}}</a></li>
                        <li><a href="#"><span>Availibility</span> : 
                            @if ($product->stock == 0)
                                <span class="text-danger mx-2">(Out of Stock)</span>
                            @elseif($product->stock < 5)
                                {{$product->stock}} <span class=" text-danger mx-2">( Low Stock )</span>
                            @else
                                In Stock
                            @endif
                        </a></li>
                        <li>
                            <a class="" href="#"><span>Avg Rating</span> : 
                                @php
                                    $stars = number_format($rating)
                                @endphp
                                @for ($i = 1; $i <= $stars; $i++)
                                <i class="fa-solid fa-star" style="color: #ffa800;"></i>
                                @endfor
                                @for ($j = $stars+ 1; $j <= 5; $j++)
                                <i class="fa fa-star"></i>
                                @endfor

                                {{-- <i class="fa fa-star"></i> --}}
                            </a>
                        </li>
     
                        <li><a href=""><span><i class="fa fa-eye"></i> : {{$viewCount}}</span></a></li>

                    </ul>
                    
                    <p>{{$product->short_desc}}</p>
                        <form action="{{route('User#CartAdd')}}" method="post">
                            @csrf
                            <input type="hidden" name="productId" value="{{$product->id}}">
                            <input type="hidden" name="userId" @if(Auth::user() != null) value="{{Auth::user()->id}}" @endif>
                            <div class="product_count">
                                <label for="qty">Quantity:</label>
                                <input type="number" name="count" id="sst" maxlength="12" value="1" title="Quantity:" class="input-text qty">
                                <button onclick="var result = document.getElementById('sst'); var sst = result.value; if (!isNaN(sst)) result.value = parseInt(sst) + 1; return false;" 
                                    class="increase items-count" type="button">
                                    <i class="lnr lnr-chevron-up"></i>
                                </button>
                                <button onclick="var result = document.getElementById('sst'); var sst = result.value; if (!isNaN(sst) && sst > 1) result.value = parseInt(sst) - 1; return false;" 
                                    class="reduced items-count" type="button">
                                    <i class="lnr lnr-chevron-down"></i>
                                </button>
                            </div>
                            
                            <div class="card_area d-flex align-items-center">
                                <input type="submit" @if($product->stock == 0) disabled @endif class=" @if($product->stock == 0) btn-secondary btn @endif primary-btn border-0" value="Add To Cart" />
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--================End Single Product Area =================-->

<!--================Product Description Area =================-->
<section class="product_description_area">
    <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Description</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact"
                 aria-selected="false">Rating</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review"
                 aria-selected="false">Comments</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                <p>{{$product->long_desc}}</p>
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="row total_rate">
                            <div class="col-6">
                                <div class="box_total">
                                    <h5>Overall Rating</h5>
                                    <h4>{{ number_format($rating, 1) }}</h4>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="rating_list">
                                    <h3>Based on Rating</h3>
                                    <ul class="list">
                                        <li><a href="#"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                 class="fa fa-star"></i><i class="fa fa-star"></i> Greate</a></li>
                                        <li><a href="#"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                 class="fa fa-star"></i><i class="fa-regular fa-star"></i> Good</a></li>
                                        <li><a href="#"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                 class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i> Normal</a></li>
                                        <li><a href="#"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa-regular fa-star"></i><i
                                                 class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i> Bad</a></li>
                                        <li><a href="#"><i class="fa fa-star"></i><i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i><i
                                                 class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i> Worse</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="review_list">
                        </div>
                    </div>
                    @if (Auth::check())
                    <div class="col-lg-6">
                        <div class="review_box">
                            <h4>Add a Rating</h4>
                            <p>Your Rating:</p>
                            <ul class="list">
                                @if (Auth::check() && $personalRating)
                                @foreach ($personalRating as $rating)
                                @for ($i = 1; $i <= $rating->count; $i++)
                                    <i class="fa-solid fa-star" style="color: #ffa800;"></i> 
                                @endfor

                                @for ($j = $rating->count + 1; $j <= 5; $j++)
                                    <i class="fa-solid fa-star"></i> 
                                @endfor
                                @endforeach
                                @endif

                            </ul>
                            <div class="row contact_form" action="contact_process.php" method="post" id="contactForm" novalidate="novalidate">
                                <div class="col-md-12 text-right">
                                    <button type="button" class="primary-btn" data-toggle="modal" data-target="#exampleModal">
                                        Add Rating
                                    </button>
                                </div>
                            </div>
                            <!-- Button trigger modal -->
                                
                                
                                <!-- Modal -->
                                <form action="{{route('rating')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="productId" value="{{$product->id}}">
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Rate this</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div id="starRating" class="stars">
                                                        <span class="star" data-value="1">&#9733;</span>
                                                        <span class="star" data-value="2">&#9733;</span>
                                                        <span class="star" data-value="3">&#9733;</span>
                                                        <span class="star" data-value="4">&#9733;</span>
                                                        <span class="star" data-value="5">&#9733;</span>
                                                    </div>
                                                    <input type="hidden" id="ratingValue" name="rating" value="1">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="primary-btn">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <div class="tab-pane fade show active" id="review" role="tabpanel" aria-labelledby="review-tab">
                
                <div class="row">
                    <div class="col-lg-6">
                        <div class="comment_list">
                           @if ($comment->count() > 0)
                           @foreach ($comment as $item)
                           <div class="review_item">
                            <div class="media">
                                <div class="d-flex">
                                    @if ($item->user_img)
                                        <img src="{{asset('/profile/'.$item->user_img)}}" width="50" alt="">
                                    @else 
                                        <img src="{{asset('admin/images/demo.png')}}" width="50" alt="">
                                    @endif
                                </div>
                                <div class="media-body">
                                    <h4>{{$item->user_name}}</h4>
                                    <h5>{{ $item->created_at->format('M d, Y \\a\\t h:ia') }}</h5>
                                    @if (Auth::check())
                                        @if ($item->user_id === Auth::user()->id)
                                            <a href="{{route('user#deleteComment',$item->id)}}" class="reply_btn btn-danger text-white">Delete</a>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <p>{{$item->message}}</p>
                        </div>
                        <hr>
                           @endforeach
                           @else 
                           <h4>There is no comment</h4>
                           @endif
                        </div>
                    </div>
                    @if (Auth::check())
                    <div class="col-lg-6">
                        <div class="review_box">
                            <h4>Post a comment</h4>
                            <form class="row contact_form" action="{{route('comment')}}" method="post" id="contactForm" novalidate="novalidate">
                                @csrf
                                <input type="hidden" name="productId" value="{{$product->id}}">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control" name="comment" id="message" rows="1" placeholder="Message"></textarea>
                                        @error('comment')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 text-right">
                                    <button type="submit" value="submit" class="btn primary-btn">Submit Now</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Product Description Area =================-->

<!-- End related-product Area -->
@endsection

@section('js-custom')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const stars = document.querySelectorAll("#starRating .star");
        const ratingValue = document.getElementById("ratingValue");

        // Highlight stars on hover
        stars.forEach(star => {
            star.addEventListener("mouseover", () => {
                highlightStars(star.dataset.value);
            });

            star.addEventListener("mouseout", () => {
                highlightStars(ratingValue.value);
            });

            // Set rating on click
            star.addEventListener("click", () => {
                ratingValue.value = star.dataset.value;
                highlightStars(ratingValue.value);
            });
        });

        function highlightStars(count) {
            stars.forEach(star => {
                star.classList.toggle("full", star.dataset.value <= count);
            });
        }

        // Initial state (1 star highlighted)
        highlightStars(ratingValue.value);
    });
</script>
@endsection