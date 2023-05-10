@php

$slider = App\Models\Slider::orderBy('slider_title','ASC')->get();

@endphp


<section class="home-slider position-relative mb-30">
    <div class="container">
        <div class="home-slide-cover mt-30">
            <div class="hero-slider-1 style-4 dot-style-1 dot-style-1-position-1">

            @foreach ($slider as $item)
                <div class="single-hero-slider single-animation-wrap" style="background-image: url({{ asset($item->slider_image) }})">
                    <div class="slider-content">                                                
                        <h1 style="color: black" class="display-2 mb-40">
                            {{ $item->slider_title }}
                        </h1>
                        <p style="color: rgb(47, 46, 46)" class="mb-65">{{ $item->short_title }}</p>
                           <a href="{{ route('become.vendor') }}">
                            <button class="cssbuttons-io-button"> Become a freelancer
                              <div class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"></path><path fill="currentColor" d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"></path></svg>
                              </div>
                            </button>
                          </a>
                    </div>
                </div>
            @endforeach    
            </div>
            <div class="slider-arrow hero-slider-1-arrow"></div>
        </div>
    </div>
</section>