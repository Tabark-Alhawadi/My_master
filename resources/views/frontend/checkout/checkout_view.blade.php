@extends('frontend.master_dashboard')

@section('main')

<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
            <span></span> Checkout
        </div>
    </div>
</div>
<div class="container mb-80 mt-30 containe">
    <div class="row">
        <div class="col-lg-8 mb-40 m-5">
            <h3 class="heading-2 mb-10">Checkout</h3>
            <div class="d-flex justify-content-between">
                <h6 class="text-body">There are Services in your cart</h6>
            </div>
        </div>
    </div>

    <form method="post" action="{{route('stripe.order')}}">
        @csrf

   

        <div class="row">
            <div class="col-lg-6 m-5">

                <div class="row">
                    <h4 class="mb-30">Billing Details</h4>


                    <div class="row">
                        <div class="form-group col-lg-6">
                            <input type="text" required="" name="shipping_name" value="{{Auth::user()->name}}">
                        </div>
                        <div class="form-group col-lg-6">
                            <input type="email" required="" name="shipping_email" value="{{Auth::user()->email}}">
                        </div>
                    </div>



                    <div class="row shipping_calculator">
                        <div class="form-group col-lg-6">
                            <input required="" type="text" name="shipping_phone" value="{{Auth::user()->phone}}" >
                        </div>
    
                    </div>


                    <div class="row shipping_calculator">
                       
                        <div class="form-group col-lg-6">
                            <input required="" type="text" name="shipping_address" value="{{Auth::user()->address}}" >
                        </div>
                    </div>

                    <div class="form-group mb-30">
                        <textarea rows="5" placeholder="Additional information" name="notes"></textarea>
                    </div>

                </div>
            </div>


            <div class="col-lg-5">
                <div class="border p-40 cart-totals ml-30 mb-50">
                    <div class="d-flex align-items-end justify-content-between mb-30">
                        <h4>Your Order</h4>
                        <h6 class="text-muted">Subtotal</h6>
                    </div>
                    <div class="divider-2 mb-30"></div>
                    <div class="order_table checkout">
                        <table class="table no-border">
                            <tbody>

                                @foreach ($carts as $cart)
                                    <tr>
                                        <td class="image product-thumbnail"><img src="{{asset($cart['product']['product_thambnail'])}}" alt="#">
                                        </td>
                                        <td>
                                            <h6 class="w-160 mb-5 long-paragraph"><a href="{{url('product/details/'.$cart['product']['id'].'/'.$cart['product']['product_slug'])}}"
                                                    class="text-heading ">{{$cart['product']['product_name']}}</a></h6></span>
                                            <div class="product-rate-cover">
                                            </div>
                                        </td>
                               

                                        @if ($cart['product']['discount_price'] == NULL)
                                            <td>
                                                <h4 class="text-brand">{{$cart['product']['selling_price']}}JD</h4>
                                            </td>
                                        @else
                                            <td>
                                                <h4 class="text-brand">{{$cart['product']['discount_price']}}JD</h4>
                                            </td>
                                        @endif

                                    @if($cart->vendor_id == NULL)
                                        <input name="admin_id" type="hidden" value="{{ $cart->admin_id}}">   
                                    @else       
                                        <input name="vendor_id" type="hidden" value="{{ $cart->vendor_id}}">                           
                                        <input name="admin_id" type="hidden" value="{{ $cart->admin_id}}">
                                    @endif
                                    
                                    </tr>
                                @endforeach
                            
                            </tbody>
                        </table>

                        <table class="table no-border">
                            <tbody>
                                <tr>
                                    <td class="cart_total_label">
                                        <h6 class="text-muted">Grand Total</h6>
                                    </td>
                                    <td class="cart_total_amount">
                                        <h4 class="text-brand text-end">{{$AllTotal}}JD</h4>
                                        <input type="hidden" value="{{$AllTotal}}" name="amount">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <button type="submit" class="CheckOut btn mb-20 w-100">PLACE ORDER</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
               
            </div>
        </div>
    </form>

</div>

<script>
    var checkboxes = document.querySelectorAll('input[type="radio"]');

// Add an event listener to each checkbox
checkboxes.forEach(function(checkbox) {
    checkbox.addEventListener('click', function() {
        // Uncheck all other checkboxes
        checkboxes.forEach(function(otherCheckbox) {
            if (otherCheckbox !== checkbox) {
                otherCheckbox.checked = false;
            }
        });
    });
});
</script>

@endsection