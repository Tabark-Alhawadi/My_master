@extends('frontend.master_dashboard')

@section('main')


<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
            <span></span> Vendor Details Page
        </div>
    </div>
</div>
<div class="container mb-30">
    <div class="archive-header-2 text-center pt-80 pb-50">
        <h1 class="display-2 mb-50">{{ $vendor->name}}</h1>
        
    </div>
    <div class="row flex-row-reverse">
        <div class="col-lg-4-5">
            <div class="shop-product-fillter">
                <div class="totall-product">
                    <p>We found <strong class="text-brand">{{ count($vproduct)}} </strong>services for you!</p>
                </div>
                <div class="sort-by-product-area">
                    <div class="sort-by-cover mr-10">
                        <div class="sort-by-product-wrap">
                            <div class="sort-by">
                                <span><i class="fi-rs-apps"></i>Show:</span>
                            </div>
                            <div class="sort-by-dropdown-wrap">
                                <span> 50 <i class="fi-rs-angle-small-down"></i></span>
                            </div>
                        </div>
                        <div class="sort-by-dropdown">
                            <ul>
                                <li><a class="active" href="#">50</a></li>
                                <li><a href="#">100</a></li>
                                <li><a href="#">150</a></li>
                                <li><a href="#">200</a></li>
                                <li><a href="#">All</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="sort-by-cover">
                        <div class="sort-by-product-wrap">
                            <div class="sort-by">
                                <span><i class="fi-rs-apps-sort"></i>Sort by:</span>
                            </div>
                            <div class="sort-by-dropdown-wrap">
                                <span> Featured <i class="fi-rs-angle-small-down"></i></span>
                            </div>
                        </div>
                        <div class="sort-by-dropdown">
                            <ul>
                                <li><a class="active" href="#">Featured</a></li>
                                <li><a href="#">Price: Low to High</a></li>
                                <li><a href="#">Price: High to Low</a></li>
                                <li><a href="#">Release Date</a></li>
                                <li><a href="#">Avg. Rating</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row product-grid">
                @foreach ($vproduct as $product)                     
                    
                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                    <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                        <div class="product-img-action-wrap">
                            <div class="product-img product-img-zoom">
                                <a href="{{url('product/details/'.$product->id.'/'.$product->product_slug)}}">
                                    <img class="default-img" src="{{ asset($product->product_thambnail) }}" alt="" />
                                </a>
                            </div>
                           
                            @php
                                $amount = $product->selling_price - $product->discount_price;
                                $discount = ($amount/$product->selling_price) * 100;
                            @endphp
                            <div class="product-badges product-badges-position product-badges-mrg">
                                @if ($product->discount_price == NULL)
                                      <span class="new">new</span>
                                    @else
                                      <span class="hot">{{ round($discount) }}%</span>
                                @endif
                                
                            </div>
                        </div>
                        <div class="product-content-wrap">
                            <div class="product-category">
                                <a href="shop-grid-right.html">{{ $product['category']['category_name'] }}</a>
                            </div>
                            <h2><a href=" {{url('product/details/'.$product->id.'/'.$product->product_slug)}} ">{{ $product->product_name }}</a></h2>
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
                            <div>
                                @if ($product->vendor_id == NULL)
                                  <span class="font-small text-muted">By <a href="vendor-details-1.html">Owner</a></span>                    
                                    @else
                                  <span class="font-small text-muted">By <a href="vendor-details-1.html">{{ $product['vendor']['name'] }}</a></span>
                                @endif
                               
                            </div>
                            <div class="product-card-bottom">

                                @if ($product->discount_price == NULL)
                                <div class="product-price">
                                    <span>{{ $product->selling_price}}JD</span>
                                </div>
                                    @else
                                <div class="product-price">
                                    <span>{{ $product->discount_price}}JD</span>
                                    <span class="old-price">{{ $product->selling_price}}JD</span>
                                </div>    
                                @endif
                                
                                <form action="{{url('/cart/data/store/'.$product->id)}}" method="POST">
                                    @csrf
                                    
                                @if($product->vendor_id == NULL)
                                        <input name="admin_id" type="hidden" value="1">   
                                @else       
                                        <input name="vendor_id" type="hidden" value="{{ $product->vendor_id}}">                           
                                        <input name="admin_id" type="hidden" value="0">
                                @endif
                                <div class="add-cart">
                                    <button class="add" style="border-color: #dfd0f1" ><i class="fi-rs-shopping-cart mr-5"></i>Add </button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end product card-->
@endforeach



                           </div>
            <!--product grid-->
            {{-- <div class="pagination-area mt-20 mb-20">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-start">
                        <li class="page-item">
                            <a class="page-link" href="#"><i class="fi-rs-arrow-small-left"></i></a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item active"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link dot" href="#">...</a></li>
                        <li class="page-item"><a class="page-link" href="#">6</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#"><i class="fi-rs-arrow-small-right"></i></a>
                        </li>
                    </ul>
                </nav>
            </div> --}}
         
            <!--End Deals-->
        </div>
        <div class="col-lg-1-5 primary-sidebar sticky-sidebar">
            <div class="sidebar-widget widget-store-info mb-30 bg-3 border-0">
                <div class="vendor-logo mb-30">
                    <img class="rounded-circle" src="{{ (!empty($vendor->photo)) ? url('upload/vendor_images/'.$vendor->photo):url('upload/no_image.jpg')}}" alt="" />
                </div>
                <div class="vendor-info">
                    <div class="product-category">
                        <span class="text-muted">Since {{ $vendor->vendor_join }}</span>
                    </div>
                    <h4 class="mb-5"><a href="vendor-details-1.html" class="text-heading">{{ $vendor->name }}</a></h4>
                    <div class="vendor-des mb-30">
                        <p class="font-sm text-heading">{{ $vendor->vendor_short_info }}</p>
                    </div>
                    <div class="vendor-info">
                        <ul class="font-sm mb-20">
                            <li><img class="mr-5" src="assets/imgs/theme/icons/icon-location.svg" alt="" /><strong>Address: </strong> <span>{{ $vendor->address }}</span></li>
                            <li><img class="mr-5" src="assets/imgs/theme/icons/icon-contact.svg" alt="" /><strong>Call Us:</strong><span>{{ $vendor->phone }}</span></li>
                        </ul>
                        <a href="#" class="btn btn-xs">Contact Seller <i class="fi-rs-arrow-small-right"></i></a>
                    </div>
                </div>
            </div>
           

        </div>
    </div>
</div>


@endsection