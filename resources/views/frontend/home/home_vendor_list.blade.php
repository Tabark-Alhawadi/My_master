@php
    $vendors = App\Models\User::where('status','active')->where('role','vendor')->orderBy('id','DESC')->limit(4)->get();
@endphp

<div class="container">

    <div class="section-title wow animate__animated animate__fadeIn" data-wow-delay="0">
                <h3 class="">All Our freelancers List </h3>
                <a class="show-all" href="{{ route('vendor.all')}}">
                    All freelancers
                    <i class="fi-rs-angle-right"></i>
                </a>
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