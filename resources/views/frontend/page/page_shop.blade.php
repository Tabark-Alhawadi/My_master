@php
     $categories = App\Models\Category::orderBy('category_name','ASC')->get();
@endphp

@extends('frontend.master_dashboard')

@section('main')

    <div class="page-header mt-30 mb-50">
        <div class="container">
            <div class="archive-header">
                <div class="row align-items-center">
                    <div class="col-xl-3">
                        <h1 class="mb-15">Categories</h1>
                        <div class="breadcrumb">
                            <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                            <span></span>Categories
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
    <div class="container mb-30">
        <div class="row flex-row-reverse mx-2">
            
            <div class="col-lg-5-5 m-auto">
                <div class="shop-product-fillter">
                    <div class="totall-product">
                        <p>We found <strong class="text-brand">{{count($categories)}}</strong> category for you!</p>
                    </div>
                   
                </div>
                {{-- <div class="row product-grid">

             
                    @foreach ($categories as $category)

                    <div class="card" style="width: 18rem;">
                        <a href="{{ url('product/category/'.$category->id.'/'.$category->category_slug) }}"><img src="{{asset($category->category_image)}}" alt="" /></a>
                        <div class="card-body">
                            <h6><a href="{{ url('product/category/'.$category->id.'/'.$category->category_slug) }}">{{$category->category_name}}</a><i class="fi-rs-arrow-small-right"></i></h6>
                        </div>
                      </div>

                      @endforeach


                </div> --}}


               

                

                  <div class="row row-cols-4 row-cols-md-4 m-auto ">     
     @foreach ($categories as $category)                                  
                    <div class="col">
                      <div class="card">
                        <a href="{{ url('product/category/'.$category->id.'/'.$category->category_slug) }}"><img src="{{asset($category->category_image)}}" alt="" /></a>
                        <div class="card-body">
                            <h4 class="text-center"><a href="{{ url('product/category/'.$category->id.'/'.$category->category_slug) }}"  class="hover-item " >{{$category->category_name}}</a></h4>
                          {{-- <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p> --}}
                        </div>
                      </div>
                    </div>
   @endforeach                   
                  </div>


                
            
        
        </div>
    </div>
@endsection