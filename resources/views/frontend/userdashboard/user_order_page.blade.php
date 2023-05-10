@extends('dashboard')
@section('user')

@php
    $route = Route::current()->getName();
@endphp


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
<div class="card">
    <div class="card-header">
        <h3 class="mb-0">Your Orders</h3>
    </div>
    <div class="card-body">
        <table class="table mb-0" >
            <thead class="table-dark">
                <tr>
                    <th>Sl</th>
                        <th>Date</th>
                        <th>Totaly</th>
                        <th>Invoice</th>
                        <th>Status</th>
                        <th>Actions</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($orders as $key=> $order)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $order->order_date }}</td>
                        <td>{{ $order->amount }}JD</td>
                        <td>{{ $order->invoice_no }}</td>
                        <td>
                            @if($order->status == 'pending')

                                <span class="badge rounded-pill bg-warning">Pending</span>

                            @elseif($order->status == 'deliverd')

                                <span class="badge rounded-pill bg-success">Deliverd</span>
                            
                            @if($order->return_order == 1)
                            <span class="badge rounded-pill " style="background:red;">Return</span>
                            @endif
                            
                            @endif
                            
                        </td>

                        <td>
                            <a href="{{ url('user/order_details/'.$order->id) }}" class="btn-sm btn-success"><i class="fa fa-eye"></i> View</a>
                            <a href="{{ url('user/invoice_download/'.$order->id) }}" class="btn-sm btn-danger"><i class="fa fa-download"></i> Invoice</a>
                        </td>
                    </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>
</div>
</div>
</div>


                </div>
                </div>
                </div>
                </div>
                </div>
@endsection


