<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Invoice</title>

<style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
    }
    table{
        font-size: x-small;
    }
    tfoot tr td{
        font-weight: bold;
        font-size: x-small;
    }
    .gray {
        background-color: lightgray
    }
    .font{
      font-size: 15px;
    }
    .authority {
        /*text-align: center;*/
        float: right
    }
    .authority h5 {
        margin-top: -10px;
        color: #8067A9;
        /*text-align: center;*/
        margin-left: 35px;
    }
    .thanks p {
        color: #8067A9;;
        font-size: 16px;
        font-weight: normal;
        font-family: serif;
        margin-top: 20px;
    }
</style>

</head>
<body>

  <table width="100%" style="background: #F7F7F7; padding:0 20px 0 20px;">
    <tr>
        <td valign="top">
          <!-- {{-- <img src="" alt="" width="150"/> --}} -->
          <h2 style="color: #8067A9; font-size: 26px;"><strong>Borderless Solutions</strong></h2>
        </td>
        <td align="right">
            <pre class="font" >
              Borderless Solutions Head Office
               Email:BorderlessSo@gmail.com <br>
               Mob: 1245454545 <br>
               Aqaba, Jordan 
            </pre>
        </td>
    </tr>

  </table>


  <table width="100%" style="background:white; padding:2px;"></table>

  <table width="100%" style="background: #F7F7F7; padding:0 5 0 5px;" class="font">
    <tr>
        <td>
          <p class="font" style="margin-left: 20px;">
           <strong>Name:</strong> {{ $order->name }} <br>
           <strong>Email:</strong> {{ $order->email }} <br>
           <strong>Phone:</strong> {{ $order->phone }} <br>
            @php
            
           
            @endphp
           <strong>Address:</strong> {{ $order->adress }}<br>
           <strong>Post Code:</strong> {{ $order->post_code }}
         </p>
        </td>
        <td>
          <p class="font">
            <h3><span style="color: #8067A9;">Invoice:</span> #{{ $order->invoice_no }}</h3>
            Order Date: {{ $order->order_date }} <br>
             Delivery Date: {{ $order->delivered_date }} <br>
         </p>
        </td>
    </tr>
  </table>
  <br/>
<h3>Services</h3>


  <table width="100%">
    <thead style="background-color: #8067A9; color:#FFFFFF;">
      <tr class="font">
        <th>Image</th>
        <th>Service Name</th>
        <th>Code</th>
        <th>Vendor</th>
        <th>price </th>
      </tr>
    </thead>
    <tbody>
      @php
      $AllTotal = 0;
  @endphp
     @foreach($orderItem as $item)
      <tr class="font">
        <td align="center">
            <img src="{{ public_path($item->product->product_thambnail) }}" height="50px;" width="50px;" alt="">
        </td>
        <td align="center">{{ $item->product->product_name }}</td>
        
        <td align="center">{{ $item->product->product_code }}</td>

        @if($item->vendor_id == NULL)
        <td align="center">BS Team</td>
         @else
         <td align="center">{{ $item->product->vendor->name }}</td>
         @endif
       
         @if ($item->product->discount_price == NULL)
         <td class="col-md-2">
                 <span>{{$item->product->selling_price}}JD</span>
             </td>
         @else
         <td class="col-md-2">
                 <span>{{$item->product->discount_price}}JD</span>             
             </td>
         @endif

        {{-- @if($item->vendor_id == NULL)
        <td align="center">
            BS Team 
        </td>
        @else
        <td align="center">
            {{ $item->product->vendor->name }}
           {{ $item['users']['name'] }}
        </td>
        @endif --}}
        {{-- <td align="center">{{ $item->product->vendor->name }}</td> --}}


        <td align="center">{{ $item->price }}JD</td>
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
    </tbody>
  </table>
  <br>
  <table width="100%" style=" padding:0 10px 0 10px;">
    <tr>
        <td align="right" >
            {{-- <h2><span style="color: #8067A9;">Subtotal:</span>{{ $order->amount }}JD</h2>
            <h2><span style="color: #8067A9;">Total:</span> {{ $order->amount }}JD</h2> --}}
            <label><span style="color: #8067A9;">Total:</span> <h4>{{ $item->price }} JD </h4></label>
        </td>
    </tr>
  </table>
  <div class="thanks mt-3">
    <p>Thanks You..!!</p>
  </div>
  <div class="authority float-right mt-5">
      <p>-----------------------------------</p>
      <h5>Authority Signature:</h5>
    </div>
</body>
</html>