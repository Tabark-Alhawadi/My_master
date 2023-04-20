@extends('admin.admin_dashboard')

@section('admin')



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<div class="page-content"> 
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Edit Slider</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Slider</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
  
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="container">
        <div class="main-body">
            <div class="row">
        
                <div class="col-lg-10">
                    <div class="card">
                        <div class="card-body">


                            <form id="my_Form" method="post" action="{{route('update.slider')}}" enctype="multipart/form-data">
                            {{---use multipart/form-data when your form includes any <input type="file"> elements---}}
                            @csrf

                            <input type="hidden" name="id" value="{{ $slider->id }}">
                            <input type="hidden" name="old_image" value="{{ $slider->slider_image }}">
                         
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">  Slider Title</h6>
                                </div>
                                <div class="form-group col-sm-9 text-secondary">
                                    <input type="text" name="slider_title" class="form-control"  value="{{ $slider->slider_title }}"/>
                                </div>
                            </div>
                         
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">  Short Title</h6>
                                </div>
                                <div class="form-group col-sm-9 text-secondary">
                                    <input type="text" name="short_title" class="form-control" value="{{ $slider->short_title }}" />
                                </div>
                            </div>
                         



                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Slider Image</h6>
                                </div>
                                <div class="form-group col-sm-9 text-secondary">
                                    <input type="file" name="slider_image" class="form-control" id="image"/>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0"> </h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                <img src="{{ asset($slider->slider_image) }}" alt="slider" id="showImage" style="width: 160px; height:130px;">
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="submit" class="btn btn-primary px-4" value="Save Changes" />
                                </div>
                            </div>
                        </div>

                        </form>



                    </div>
                  
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                slider_name: {
                    required : true,
                }, 
            },
            messages :{
                slider_name: {
                    required : 'Please Enter slider Name',
                },
            },
            errorElement : 'span', 
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });
    
</script>



<script type="text/javascript">
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>




@endsection