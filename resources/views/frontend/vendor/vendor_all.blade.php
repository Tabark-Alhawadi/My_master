@extends('frontend.master_dashboard')

@section('main')


<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
            <span></span> Freelancers List
        </div>
    </div>
</div>
<div class="page-content pt-50">
    <div class="container">
        <div class="archive-header-2 text-center">
            <h1 class="display-2 mb-50">Freelancers List</h1>
            <div class="row">
                <div class="col-lg-5 mx-auto">
                    <div class="sidebar-widget-2 widget_search mb-50">
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-50">
            <div class="col-12 col-lg-8 mx-auto">
                <div class="shop-product-fillter">
                    <div class="totall-product">
                        <p>We have <strong class="text-brand">{{count($vendors)}}</strong> freelancers now</p>
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


                    </div>
                </div>
            </div>
        </div>


        
        <div class="row vendor-grid">


           
        <div class="team-boxed"> 
           
            <div class="container">
               
                <div class="row people">
                    @foreach ($vendors as $vendor)  
                    <div class="col-md-6 col-lg-3 item">
                        <div class="box">  <img class="default-img rounded-circle" src="{{ (!empty($vendor->photo)) ? url('upload/vendor_images/'.$vendor->photo):url('upload/no_image.jpg')}}"  alt="" />
                            <h4 class="mb-5"><a href="{{ route('vendor.details',$vendor->id) }}">{{ $vendor->name }}</a></h4>
                            <span class="text-muted">Since {{ $vendor->vendor_join }}</span>
                          
                            <div class="mb-10">
                                @php
                                           $products = App\Models\Product::where('vendor_id',$vendor->id)->get();
                                       @endphp
                                <span class="font-small total-product">{{ count($products)}} services</span>
                                <div class="vendor-info mb-30">
                                    <ul class="contact-infor text-dark">
                                        <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-location.svg')}}" alt="" /><strong>Address:</strong><span>{{ $vendor->address }}</span></li>
                                        
                                        <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-contact.svg')}}" alt="" /><strong>Call Us:</strong><span>{{ $vendor->phone }}</span></li>
                                    </ul>
                                </div>
                                <a href="{{ route('vendor.details',$vendor->id) }}" class="btn btn-xs">View My Services <i class="fi-rs-arrow-small-right"></i></a>
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

@endsection