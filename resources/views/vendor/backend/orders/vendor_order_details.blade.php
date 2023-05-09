@extends('vendor.vendor_dashboard')

@section('vendor')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Vendor Order Details</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Vendor Order Details</li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->

    <hr />


    <div class="row row-cols-1 row-cols-md-1 row-cols-lg-2 row-cols-xl-2">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4>Shipping Details</h4>
                </div>
                <hr>
                <div class="card-body">
                    <table class="table" style="background:#F4F6FA;font-weight: 600;">
                        <tr>
                            <th>Shipping Name:</th>
                            <th>{{ $order->name }}</th>
                        </tr>

                        <tr>
                            <th>Shipping Phone:</th>
                            <th>{{ $order->phone }}</th>
                        </tr>

                        <tr>
                            <th>Shipping Email:</th>
                            <th>{{ $order->email }}</th>
                        </tr>

                        <tr>
                            <th>Shipping Address:</th>
                            <th>{{ $order->adress }}</th>
                        </tr>



                        <tr>
                            <th>Post Code :</th>
                            <th>{{ $order->post_code }}</th>
                        </tr>

                        <tr>
                            <th>Order Date :</th>
                            <th>{{ $order->order_date }}</th>
                        </tr>

                    </table>

                </div>

            </div>
        </div>


        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4>Order Details
                        <span class="text-danger">Invoice : {{ $order->invoice_no }} </span>
                    </h4>
                </div>
                <hr>
                <div class="card-body">
                    <table class="table" style="background:#F4F6FA;font-weight: 600;">
                        <tr>
                            <th> Name :</th>
                            <th>{{ $order->user->name }}</th>
                        </tr>

                        <tr>
                            <th>Phone :</th>
                            <th>{{ $order->user->phone }}</th>
                        </tr>


                        <tr>
                            <th>Invoice:</th>
                            <th class="text-danger">{{ $order->invoice_no }}</th>
                        </tr>

                        <tr>
                            <th>Order Amonut:</th>
                            <th>{{ $order->amount }}JD</th>
                        </tr>

                        <tr>
                            <th>Order Status:</th>
                            <th><span class="badge bg-danger" style="font-size: 15px;">{{ $order->status }}</span></th>
                        </tr>


                        <tr>
                            <th> </th>
                            <th>
                                @if($order->status == 'pending')
                                <a href="{{ route('vendor.processing-delivered',$order->id) }}"
                                    class="btn btn-block btn-success" id="delivered">Delivered Order</a>
                                    
                                @endif

                            </th>
                        </tr>

                    </table>

                </div>

            </div>
        </div>
    </div>






    <div class="row row-cols-1 row-cols-md-1 row-cols-lg-2 row-cols-xl-1">
        <div class="col">
            <div class="card">


                <div class="table-responsive">
                    <table class="table" style="font-weight: 600;">
                        <tbody>
                            <tr>
                                <td class="col-md-1">
                                    <label>Image </label>
                                </td>
                                <td class="col-md-2">
                                    <label>Product Name </label>
                                </td>
                                {{-- <td class="col-md-2">
                                    <label>Vendor Name </label>
                                </td> --}}
                                <td class="col-md-2">
                                    <label>Product Code </label>
                                </td> 

                                <td class="col-md-3">
                                    <label>Price </label>
                                </td>

                            </tr>
                            @php
                            $AllTotal = 0;
                        @endphp

                            @foreach($orderItem as $item)
                            <tr>
                                <td class="col-md-1">
                                    <label><img src="{{ asset($item->product->product_thambnail) }}"
                                            style="width:50px; height:50px;"> </label>
                                </td>
                                <td class="col-md-2">
                                    <label>{{ $item->product->product_name }}</label>
                                </td>
                                {{-- @if($item->vendor_id == NULL)
                                <td class="col-md-2">
                                    <label>Owner </label>
                                </td>
                                @else
                                <td class="col-md-2">
                                    <label>{{ $item->product->vendor->name }} </label>
                                </td>
                                @endif --}}

                                <td class="col-md-2">
                                    <label>{{ $item->product->product_code }} </label>
                                </td>
                                

                            @if ($item->product->discount_price == NULL)
                            <td class="col-md-2">
                                    <span>{{$item->product->selling_price}}JD</span>
                                </td>
                            @else
                            <td class="col-md-2">
                                    <span>{{$item->product->discount_price}}JD</span>             
                                </td>
                            @endif


                               
                                   
                               
                               

                              
                               

                               

                            </tr>  
                        @php
                            if ($item['product']['discount_price'] == NULL) {

                                $selling_price = $item['product']['selling_price'];
                                $total = $selling_price;
                                $AllTotal +=$total;

                            }else {
                                $discount_price = $item['product']['discount_price'];
                                $total = $discount_price; 
                                $AllTotal +=$total;

                            }
                        @endphp
                            @endforeach
    

                                <td class="col-md-3">
                                    <label> Total = {{ $AllTotal }}JD </label>
                                </td>
                        </tbody>
                    </table>

                </div>



            </div>
        </div>

    </div>






</div>

@endsection
