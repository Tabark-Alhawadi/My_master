@extends('dashboard')
@section('user')
@php
    $route = Route::current()->getName();
@endphp

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>


<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
            <span></span> Pages <span></span> My Account
        </div>
    </div>
</div>
<div class="page-content pt-150 pb-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 m-auto">
                <div class="row">
                    <div class="col-md-3">
                        <div class="dashboard-menu">
                            <ul class="nav flex-column" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link {{ ($route ==  'dashboard')? 'active':  '' }} "   href="{{route('dashboard')}}" ><i class="fi-rs-settings-sliders mr-10"></i>Dashboard</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ ($route ==  'user.order.page')? 'active':  '' }} "  href="{{route('user.order.page')}}"  ><i class="fi-rs-shopping-bag mr-10"></i>Orders</a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a class="nav-link {{ ($route ==  'dashboard')? 'active':  '' }} "   href="#track-orders"><i class="fi-rs-shopping-cart-check mr-10"></i>Track Your Order</a>
                                </li> --}}
                                <li class="nav-item">
                                    <a class="nav-link {{ ($route ==  'reply.message.page')? 'active':  '' }} "   href="{{route('reply.message.page')}}"  ><i class="fi-rs-user mr-10"></i>Reply Message</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="account-detail-tab" data-bs-toggle="tab" href="#account-detail" role="tab" aria-controls="account-detail" aria-selected="true"><i class="fi-rs-user mr-10"></i>Account details</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="change-password-tab" data-bs-toggle="tab" href="#change-password" role="tab" aria-controls="change-password" aria-selected="true"><i class="fi-rs-user mr-10"></i>Change Password</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('user.logout' )}}"><i class="fi-rs-sign-out mr-10"></i>Logout</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="tab-content account dashboard-content pl-50">
                            <div class="tab-pane fade active show" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="mb-0">Hello {{ Auth::user()->name}}</h3>
                                        <br>
                                        <img src="{{ (!empty($userData->photo)) ? url('upload/user_images/'.$userData->photo):url('upload/no_image.jpg')}}" alt="User" class="rounded-circle p-1 bg-primary" width="110" id="showImage">
                                    </div>
                                    <div class="card-body">
                                        <p>
                                            From your account dashboard. you can easily edit your password and account details.</a>
                                        </p>
                                    </div>
                                </div>
                            </div>








                            <div class="tab-pane fade" id="account-detail" role="tabpanel" aria-labelledby="account-detail-tab">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Account Details</h5>
                                    </div>
                                    <div class="card-body">
                                      
                                        <form method="post" action="{{route('user.profile.store')}}" enctype="multipart/form-data">
                                            {{---use multipart/form-data when your form includes any <input type="file"> elements---}}
                                            @csrf

                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>User Name <span class="required">*</span></label>
                                                    <input required="" class="form-control" name="username" type="text" value="{{ $userData->username}}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Full Name <span class="required">*</span></label>
                                                    <input required="" class="form-control" name="name" value="{{ $userData->name}}">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>Email <span class="required">*</span></label>
                                                    <input required="" class="form-control" name="email" type="text" value="{{ $userData->email}}">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>Phone  <span class="required">*</span></label>
                                                    <input required="" class="form-control" name="phone" type="text" value="{{ $userData->phone}}">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>Address <span class="required">*</span></label>
                                                    <input required="" class="form-control" name="address" type="text" value="{{ $userData->address}}">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>User Photo <span class="required">*</span></label>
                                                    <input  class="form-control" name="photo" type="file" id="image" accept="image/x-png,image/gif,image/jpeg,image/jpg,image/webp">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label> <span class="required">*</span></label>
                                                    <img src="{{ (!empty($userData->photo)) ? url('upload/user_images/'.$userData->photo):url('upload/no_image.jpg')}}" alt="User" class="rounded-circle p-1 bg-primary" width="110" id="showImage">
                                                </div>
                                                <div class="col-md-12">
                                                    <button type="submit" class="btn btn-fill-out submit font-weight-bold" name="submit" value="Submit">Save Change</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>















                            {{-- Change Password --}}

                            <div class="tab-pane fade" id="change-password" role="tabpanel" aria-labelledby="change-password-tab">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Change Password</h5>
                                    </div>
                                    <div class="card-body">
                                      
                                        <form method="post" action="{{route('user.update.password')}}" >
                                            @csrf
                                            
                                @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{session('status')}}
                                </div>
                            @elseif (session('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{session('error')}}
                                </div>
                            @endif


                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label>Old Password <span class="required">*</span></label>
                                                    <input class="form-control  @error('old_password') is-invalid @enderror" name="old_password" type="password" id="current_password"  placeholder="Old Password">
                                                    @error('old_password')
                                                    <span class="text-danger">{{ $message }}</span> 
                                                     @enderror
                                                </div>

                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label>New Password <span class="required">*</span></label>
                                                    <input class="form-control  @error('new_password') is-invalid @enderror" type="password" name="new_password" id="new_password" placeholder="New Password">
                                                    @error('new_password')
                                                   <span class="text-danger">{{ $message }}</span> 
                                                   @enderror
                                                </div>

                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label>Confirm New Password <span class="required">*</span></label>
                                                    <input class="form-control" type="password" id="new_password_confirmation" name="new_password_confirmation"  placeholder="Confirm New Password">
                                                </div>
                                         

                                                <div class="col-md-12">
                                                    <button type="submit" class="btn btn-fill-out submit font-weight-bold" name="submit" value="Submit">Save Change</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>





                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);
             }
             reader.readAsDataURL(e.target.files['0']);
        })
    })
</script>
@endsection