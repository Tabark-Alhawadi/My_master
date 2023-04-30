<style>
    button {
  --primary-color: #24012f ;
  --secondary-color: #fff;
  --hover-color: #8067A9;
  --arrow-width: 10px;
  --arrow-stroke: 2px;
  box-sizing: border-box;
  border: 0;
  border-radius: 20px;
  color: var(--secondary-color);
  padding: 1.3em 1.8em;
  background: var(--primary-color);
  display: flex;
  transition: 0.2s background;
  align-items: center;
  gap: 0.6em;
  font-weight: bold;
}

button .arrow-wrapper {
  display: flex;
  justify-content: center;
  align-items: center;
}

button .arrow {
  margin-top: 1px;
  width: var(--arrow-width);
  background: var(--primary-color);
  height: var(--arrow-stroke);
  position: relative;
  transition: 0.2s;
}

button .arrow::before {
  content: "";
  box-sizing: border-box;
  position: absolute;
  border: solid var(--secondary-color);
  border-width: 0 var(--arrow-stroke) var(--arrow-stroke) 0;
  display: inline-block;
  top: -3px;
  right: 3px;
  transition: 0.2s;
  padding: 3px;
  transform: rotate(-45deg);
}

button:hover {
  background-color: var(--hover-color);
}

button:hover .arrow {
  background: var(--secondary-color);
}

button:hover .arrow:before {
  right: 0;
}
</style>

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
                            {{-- <a href="{{ route('become.vendor') }}" >Become a Vendor</a> --}}
                           <a href="{{ route('become.vendor') }}"> <button>
                                Become a Vendor
                                <div class="arrow-wrapper">
                                    <div class="arrow"></div>
                                </div>
                            </button> </a>
                    </div>
                </div>
            @endforeach    
            </div>
            <div class="slider-arrow hero-slider-1-arrow"></div>
        </div>
    </div>
</section>