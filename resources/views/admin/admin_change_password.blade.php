<link rel="stylesheet" href="{{URL::asset('adminbackend\css\user_profile.css')}}">
@extends('admin.admin_dashboard')

@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid mt--7">
            <div class="row">
            
                <div class="col-xl-12 order-xl-1">
                    <div id="edit">
                        <div class="card-body">
                            <form method="post" action="{{route('update.password')}}">
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

                                <h4>Change Password</h4>
                                <hr class="my-4">
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group focused">
                                                <label class="form-control-label">Old Password</label>
                                                <input type="password" name="old_password" id="current_password"  placeholder="***********" class="form-control padding form-control-alternative @error('old_password') is-invalid @enderror ">
                                                @error('old_password')
                                                   <span class="text-danger">{{ $message }}</span> 
                                                @enderror
                                            </div>
                                            <div class="form-group focused">
                                                <label class="form-control-label">New Password</label>
                                                <input type="password" name="new_password" id="new_password"  placeholder="***********" class="form-control padding form-control-alternative @error('new_password') is-invalid @enderror ">
                                                @error('new_password')
                                                   <span class="text-danger">{{ $message }}</span> 
                                                @enderror
                                            </div>
                                            <div class="form-group focused">
                                                <label class="form-control-label">Confirm New Password</label>
                                                <input type="password" id="new_password_confirmation" name="new_password_confirmation" placeholder="***********" class="form-control padding form-control-alternative">
                                            </div> 
                                            <div class="form-group focused">
                                                <button type="submit" class="btn btn-sm btn-primary">Save Changes</button>
                                            </div>
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


@endsection