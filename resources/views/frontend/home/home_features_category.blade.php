@php
     $categories = App\Models\Category::orderBy('category_name','ASC')->get();
@endphp

<section class="popular-categories section-padding">
    <div class="container wow animate__animated animate__fadeIn">

        <div class="section-title wow animate__animated animate__fadeIn" data-wow-delay="0">
            <h3 class="">Categories </h3>
            <a class="show-all" href="{{ route('category.all')}}">
                All Categories
                <i class="fi-rs-angle-right"></i>
            </a>
        </div>
        <div class="carausel-10-columns-cover position-relative">
            <div class="carausel-10-columns" id="carausel-10-columns">

                @foreach ($categories as $category)

                <div class="col-md-6 mt-4 ">
                    <div class="card profile-card-5">
                        <div class="card-img-block">
                            <a href="{{ url('product/category/'.$category->id.'/'.$category->category_slug) }}"><img src="{{asset($category->category_image)}}"alt="" /></a>
                        </div>
                        <div class="card-body pt-0">
                            <h6><a href="{{ url('product/category/'.$category->id.'/'.$category->category_slug) }}">{{$category->category_name}}</a><i class="fi-rs-arrow-small-right"></i></h6>
                        
                      </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
    <br>
    <br>
</section>