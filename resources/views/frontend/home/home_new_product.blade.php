@php
    $products = App\Models\Product::where('status',1)->orderBy('id','ASC')->limit(10)->get();
    $categories = App\Models\Category::orderBy('category_name','ASC')->get();
@endphp


<section class="product-tabs section-padding position-relative">
    <div class="container">
        <div class="section-title style-2 wow animate__animated animate__fadeIn">
            <h3> Services </h3>
            <ul class="nav nav-tabs links" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="nav-tab-one" data-bs-toggle="tab" data-bs-target="#tab-one" type="button" role="tab" aria-controls="tab-one" aria-selected="true">All</button>
                </li>
                @foreach ($categories as $category)
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="nav-tab-two" data-bs-toggle="tab" href="#category{{$category->id}}" type="button" role="tab" aria-controls="tab-two" aria-selected="false">
                            {{ $category->category_name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        <!--End nav-tabs-->
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                <div class="row product-grid-4">


 @foreach ($products as $product)                     
                    
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
                                    <a href="#">{{ $product['category']['category_name'] }}</a>
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
                                      <span class="font-small text-muted">By <a href="">Owner</a></span>                    
                                        @else
                                      <span class="font-small text-muted">By <a href="">{{ $product['vendor']['name'] }}</a></span>
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
                                        <button class="add" style="border-color: #dfd0f1"><i class="fi-rs-shopping-cart mr-5"></i>Add </button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end product card-->
 @endforeach

               
 
                </div>
                <!--End product-grid-4-->
            </div>
            <!--En tab one-->
            @foreach ($categories as $category)

            <div class="tab-pane fade" id="category{{$category->id}}" role="tabpanel" aria-labelledby="tab-two">
                <div class="row product-grid-4">
                    @php
                        $catWiseProduct = App\Models\Product::where('category_id',$category->id)->orderBy('id','DESC')->limit(10)->get();
                    @endphp
                    
                    @forelse ($catWiseProduct as $product)
                        <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                            <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                                <div class="product-img-action-wrap">
                                    <div class="product-img product-img-zoom">
                                        <a href="{{url('product/details/'.$product->id.'/'.$product->product_slug)}}">
                                            <img class="default-img" src="{{asset($product->product_thambnail)}} " alt="" />
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
                                    <div class="product-category">
                                        <a href="#">{{$product['category']['category_name']}}</a>
                                    </div>
                                    <h2><a href="{{url('product/details/'.$product->id.'/'.$product->product_slug)}}">{{$product->product_name}}</a></h2>
                                    <div class="product-rate-cover">


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
                                        <span class="font-small text-muted">By <a href="vendor-details-1.html">Owner</a></span>
                                    </div>
                                    <div class="product-card-bottom">
                                        
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
                    @empty
                        <h4 class="text-danger">No Product Found</h4>
                        <br>
                    @endforelse
                        <!--end product card-->
                </div>
                <!--End product-grid-4-->
            </div>
        @endforeach

        <!--En tab two-->
    </div>
    <!--End tab-content-->
</div>
</section>
<br>
<br>