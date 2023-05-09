
@extends('frontend.master_dashboard')

@section('main')




<style>
    div.stars {

width: 270px;

display: inline-block;

}

.mt-200{
   margin-top:200px;  
}

input.star { display: none; }



label.star {

float: right;

padding: 10px;

font-size: 36px;

color: #4A148C;

transition: all .2s;

}



input.star:checked ~ label.star:before {

content: '\f005';

color: #FD4;

transition: all .25s;

}


input.star-5:checked ~ label.star:before {

color: #FE7;

text-shadow: 0 0 20px #952;

}



input.star-1:checked ~ label.star:before { color: #F62; }

  

label.star:hover { transform: rotate(-15deg) scale(1.3); }



label.star:before {

content: '\f006';

font-family: FontAwesome;

}
</style>




    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> <a href="shop-grid-right.html">{{$product['category']['category_name']}}</a> <span></span>{{$product['subcategory']['subcategory_name']}} <span></span>{{$product->product_name}}
            </div>
        </div>
    </div>
    <div class="container mb-30">
        <div class="row">
            <div class="col-xl-10 col-lg-12 m-auto">
                <div class="product-detail accordion-detail">
                    <div class="row mb-50 mt-30">
                        <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                            <div class="detail-gallery">
                                <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                                <!-- MAIN SLIDES -->
                                <div class="product-image-slider">
                                    
                                    @foreach ($multiImg as $img)
                                        <figure class="border-radius-10">
                                            <img src="{{ asset($img->photo_name) }}" alt="product image" />
                                        </figure>
                                    @endforeach
                                   
                                </div>
                                <!-- THUMBNAILS -->
                                <div class="slider-nav-thumbnails">

                                    @foreach ($multiImg as $img)
                                        <div><img src="{{ asset($img->photo_name) }}" alt="product image" /></div>
                                    @endforeach

                                </div>
                            </div>
                            <!-- End Gallery -->
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="detail-info pr-30 pl-30">

                                @if ($product->product_qty > 0)
                                    <span class="stock-status in-stock"> Available </span>
                                @else
                                    <span class="stock-status out-stock"> UnAvailable </span>
                                @endif

                                <h2 class="title-detail">{{$product->product_name}}</h2>
                                <div class="product-detail-rating">
                                    <div class="product-rate-cover text-end">
                
                                        @php
                
                                        $reviewcount = App\Models\Review::where('product_id',$product->id)->where('status',1)->latest()->get();
                
                                        $avarage = App\Models\Review::where('product_id',$product->id)->where('status',1)->avg('rating');
                                        @endphp
                                        
                
                                        <div class="product-rate d-inline-block">
                                            @if($avarage == 0)
                                            
                                            @elseif($avarage == 1 || $avarage < 2)                     
                                            <div class="product-rating" style="width: 20%"></div>
                                            @elseif($avarage == 2 || $avarage < 3)                     
                                            <div class="product-rating" style="width: 40%"></div>
                                            @elseif($avarage == 3 || $avarage < 4)                     
                                            <div class="product-rating" style="width: 60%"></div>
                                            @elseif($avarage == 4 || $avarage < 5)                     
                                            <div class="product-rating" style="width: 80%"></div>
                                            @elseif($avarage == 5 || $avarage < 5)                     
                                            <div class="product-rating" style="width: 100%"></div>
                                            @endif
                                        </div>
                
                
                
                                        <span class="font-small ml-5 text-muted"> ({{ count($reviewcount)}} reviews)</span>
                                    </div>
                                </div>

                                @php
                                    $amount = $product->selling_price - $product->discount_price;
                                    $discount = ($amount/$product->selling_price)*100;
                                @endphp
                                <div class="clearfix product-price-cover">
                                    <div class="product-price primary-color float-left">

                                      
                                        @if ($product->discount_price == NULL)
                                            <span class="current-price text-brand">{{$product->selling_price}}JD</span>
                                        @else

                                            <span class="current-price text-brand">{{$product->discount_price}}JD</span>
                                            <span>
                                                <span class="save-price font-md ml-15" style="color: #24012f">{{round($discount)}}% Off</span>
                                                <span class="old-price font-md ml-15">{{$product->selling_price}}JD</span>
                                            </span>
                                        @endif
                                       
                                    </div>
                                </div>
                                <div class="short-desc mb-30">
                                    <p class="font-lg">{{ $product->short_descp}}</p>
                                </div>

                               
                        <form action="{{url('/cart/data/store/'.$product->id)}}" method="POST">
                            @csrf

                            @if($product->vendor_id == NULL)
                                 <input name="admin_id" type="hidden" value="1">   
                            @else       
                                 <input name="vendor_id" type="hidden" value="{{ $product->vendor_id}}">                           
                                 <input name="admin_id" type="hidden" value="0">
                            @endif
                                <div class="detail-extralink mb-50">
                                    
                                    <div class="product-extra-link2">
                                        <button type="submit" class="button button-add-to-cart"><i class="fi-rs-shopping-cart"></i>Add to cart</button>
                                    </div>
                                </div>
                        </form>
                               
                              
                                    @if ($product->vendor_id == NULL)
                                    <h6 >By <span style="color:#8067A9">Owner</span></h6>                    
                                      @else
                                    <h6 >By <span style="color:#8067A9">{{ $product['vendor']['name'] }}</span></h6>
                                  @endif
                         
                                <div class="font-xs">
                                    <ul class="mr-50 float-start">

                                        <li class="mb-5">Category:<span class="text-brand">{{$product['category']['category_name']}}</span></li>
                                        <li class="mb-5">SubCategory:<span class="text-brand">{{$product['subcategory']['subcategory_name']}}</span></li>
                                    </ul>
                                    <ul class="float-start">
                                        <li class="mb-5">Product Code: <a href="#">{{$product->product_code}}</a></li>
                                        <li class="mb-5">Tags: <a href="#" rel="tag">{{$product->product_tags}}</a></li>
                                        {{-- <li>Stock:<span class="in-stock text-brand ml-5">({{$product->product_qty}}) Items In Stock</span></li> --}}
                                    </ul>
                                </div>
                            </div>
                            <!-- Detail Info -->
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="tab-style3">
                            <ul class="nav nav-tabs text-uppercase">
                                <li class="nav-item">
                                    <a class="nav-link active" id="Description-tab" data-bs-toggle="tab" href="#Description">Description</a>
                                </li>
                               
                                <li class="nav-item">
                                    <a class="nav-link" id="Vendor-info-tab" data-bs-toggle="tab" href="#Vendor-info">freelancer</a>
                                </li>
                                @php
                                $reviews = App\Models\Review::where('product_id',$product->id)->latest()->limit(5)->get();
                            @endphp
                                <li class="nav-item">
                                    <a class="nav-link" id="Reviews-tab" data-bs-toggle="tab" href="#Reviews">Reviews ({{count($reviews)}})</a>
                                </li>
                            </ul>
                            <div class="tab-content shop_info_tab entry-main-content">
                                <div class="tab-pane fade show active" id="Description">
                                    <div class="">
                                        <p>{!! $product->long_descp !!}</p>
                                    </div>
                                </div>
                        
                                <div class="tab-pane fade" id="Vendor-info">
                                    <div class="vendor-logo d-flex mb-30">
                                        <img src="{{ (!empty($product->vendor->photo)) ? url('upload/vendor_images/'.$product->vendor->photo):url('upload/no_image.jpg')}}" alt="" />
                                        <div class="vendor-name ml-15">
                                            @if ($product->vendor_id == NULL)
                                            <h6>
                                                <a href="vendor-details-2.html">Owner</a>
                                            </h6>
                                                @else
                                            <h6>
                                                <a href="#">{{$product['vendor']['name']}}</a>
                                            </h6>
                                            @endif
                                            
                                            <div class="product-rate-cover text-end">
                                                {{-- <div class="product-rate d-inline-block">
                                                    <div class="product-rating" style="width: 90%"></div>
                                                </div>
                                                <span class="font-small ml-5 text-muted"> (({{count($reviews)}}) reviews)</span> --}}
                                            </div>
                                        </div>
                                    </div>

                                    @if ($product->vendor_id == NULL)
                                      <ul class="contact-infor mb-50">
                                          <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-location.svg')}}" alt="" /><strong>Address: </strong> <span>Null</span></li>
                                          <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-contact.svg')}}" alt="" /><strong>Contact freelancer:</strong><span>Admin</span></li>
                                      </ul>
                                    @else                                    
                                      <ul class="contact-infor mb-50">
                                          <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-location.svg')}}" alt="" /><strong>Address: </strong> <span>{{$product['vendor']['address']}}</span></li>
                                          <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-contact.svg')}}" alt="" /><strong>Contact freelancer:</strong><span>{{$product['vendor']['phone']}}</span></li>
                                      </ul>
                                    @endif

                                    @if ($product->vendor_id == NULL)
                                    <p>Owner Information</p>
                                        @else
                                    <p>{{$product['vendor']['vendor_short_info']}}</p>
                                    @endif
                                </div>


                                <div class="tab-pane fade" id="Reviews">
                                    <!--Comments-->
                                <div class="comments-area">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <h4 class="mb-30">Customer questions & answers</h4>
                                            <div class="comment-list">
                                               
                            
                                                @foreach($reviews as $item)
                                                    
                                                    @if($item->status == 0)
                            
                                                    @else 
                            
                                                    <div class="single-comment justify-content-between d-flex mb-30">
                                                        <div class="user justify-content-between d-flex">
                                                            <div class="thumb text-center">
                                                                <img src="{{ (!empty($item->user->photo)) ? url('upload/user_images/'.$item->user->photo):url('upload/no_image.jpg') }}" alt="" />
                                                              
                                                            </div>
                                                            <div class="desc">
                                                                <div class="d-flex justify-content-between mb-10">
                                                                    <div >
                                                                         <a  class="font-heading text-brand">{{ $item->user->name }}</a>
                                                                    </div>
                                                                    
                                                                    <div class="d-flex align-items-center">
                                                                       
                                                                        <span class="font-xs text-muted"> {{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }} </span>
                                                                    </div>
                                                                    
                                                                    <div class="product-rate d-inline-block">
                                                                        @if($item->rating == NULL)
                                                                            @elseif($item->rating == 1)
                                                                            <div class="product-rating" style="width: 20%"></div>
                                                                            @elseif($item->rating == 2)
                                                                            <div class="product-rating" style="width: 40%"></div>
                                                                            @elseif($item->rating == 3)
                                                                            <div class="product-rating" style="width: 60%"></div>
                                                                            @elseif($item->rating == 4)
                                                                            <div class="product-rating" style="width: 80%"></div>
                                                                            @elseif($item->rating == 5)
                                                                            <div class="product-rating" style="width: 100%"></div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <p class="mb-10" style="color: black">{{ $item->comment }} </p>
                                                            </div>
                                                        </div>
                                                    </div>
                            
                                                    @endif
                            
                            
                                                @endforeach
                                                
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--comment form-->

                                <div class="comment-form">
                                    <h4 class="mb-15">Add a review</h4>
                                    @guest
                                        <p> <b>For Add Product Review. You Need To Login First <a
                                                    href="{{ route('login')}}">Login Here </a> </b></p>
                                    @else
                                        <div class="row">
                                            <div class="col-lg-8 col-md-12">
                                                <form class="form-contact comment_form" action="{{ route('store.review') }}" method="post" id="commentForm">
                                                    @csrf

                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                                                    <div class="row">
                                                        <table class="table" style=" width: 60%;">
                                                        <div class="col-md-12">
                                                
                                                            <div class="stars">
                                                
                                                
                                                                    <input class="star star-5 radio-sm" id="star-5" type="radio" value="5" name="quality" />
                                                
                                                                    <label class="star star-5 radio-sm" for="star-5"></label>
                                                
                                                                    <input class="star star-4 radio-sm" id="star-4" type="radio" value="4" name="quality" />
                                                
                                                                    <label class="star star-4 radio-sm" for="star-4"></label>
                                                
                                                                    <input class="star star-3 radio-sm" id="star-3" type="radio" value="3" name="quality" />
                                                
                                                                    <label class="star star-3 radio-sm" for="star-3"></label>
                                                
                                                                    <input class="star star-2 radio-sm" id="star-2" type="radio" value="2" name="quality" />
                                                
                                                                    <label class="star star-2 radio-sm" for="star-2"></label>
                                                
                                                                    <input class="star star-1 radio-sm" id="star-1" type="radio" value="1" name="quality" />
                                                
                                                                    <label class="star star-1 radio-sm" for="star-1"></label>
                                                
                                                            </div>
                                                
                                                
                                                
                                                        </div>
                                                    </table>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <textarea class="form-control w-100" required name="comment" id="comment"
                                                                    cols="30" rows="9" placeholder="Write Comment"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="button button-contactForm">Submit
                                                            Review</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    @endguest
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-60">
                        <div class="col-12">
                            <h2 class="section-title style-1 mb-30">Related products</h2>
                        </div>
                        <div class="col-12">
                            <div class="row related-products">
                                @foreach ($relatedProduct as $product)
                                    
                                    <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                                        <div class="product-cart-wrap hover-up">
                                            <div class="product-img-action-wrap">
                                                <div class="product-img product-img-zoom">
                                                    <a href="{{url('product/details/'.$product->id.'/'.$product->product_slug)}}" tabindex="0">
                                                        <img class="default-img" src="{{ asset($product->product_thambnail) }}" alt="" />
                                                    </a>
                                                </div>
                                               

                                                @php
                                                    $amount = $product->selling_price - $product->discount_price;
                                                    $discount = ($amount/$product->selling_price)*100;
                                                @endphp
                                                <div class="product-badges product-badges-position product-badges-mrg">
                                                    @if ($product->discount_price == NULL)
                                                        <span class="new">New </span>
                                                    @else
                                                        <span class="hot">{{round($discount)}}% </span>
                                                    @endif
                                                </div>
                                                
                                            </div>
                                            <div class="product-content-wrap">
                                                <h2><a href="{{url('product/details/'.$product->id.'/'.$product->product_slug)}}" tabindex="0">{{$product->product_name}}</a></h2>
                                                <div class="product-detail-rating">
                                                    <div class="product-rate-cover text-end">
                                
                                                        @php
                                
                                                        $reviewcount = App\Models\Review::where('product_id',$product->id)->where('status',1)->latest()->get();
                                
                                                        $avarage = App\Models\Review::where('product_id',$product->id)->where('status',1)->avg('rating');
                                                        @endphp
                                                        
                                
                                                        <div class="product-rate d-inline-block">
                                                            @if($avarage == 0)
                                                            
                                                            @elseif($avarage == 1 || $avarage < 2)                     
                                                            <div class="product-rating" style="width: 20%"></div>
                                                            @elseif($avarage == 2 || $avarage < 3)                     
                                                            <div class="product-rating" style="width: 40%"></div>
                                                            @elseif($avarage == 3 || $avarage < 4)                     
                                                            <div class="product-rating" style="width: 60%"></div>
                                                            @elseif($avarage == 4 || $avarage < 5)                     
                                                            <div class="product-rating" style="width: 80%"></div>
                                                            @elseif($avarage == 5 || $avarage < 5)                     
                                                            <div class="product-rating" style="width: 100%"></div>
                                                            @endif
                                                        </div>
                                
                                
                                
                                                        <span class="font-small ml-5 text-muted"> ({{ count($reviewcount)}} reviews)</span>
                                                    </div>
                                                </div>
                                               
                                                @if ($product->discount_price == NULL)
                                                    <div class="product-price">
                                                        <span>{{$product->selling_price}}JD</span>
                                                    </div>
                                                @else
                                                    <div class="product-price">
                                                        <span>{{$product->discount_price}}JD</span>
                                                        <span class="old-price">{{$product->selling_price}}JD</span>
                                                    </div>
                                                @endif

                                                
                                            </div>
                                        </div>
                                    </div>
                                
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection