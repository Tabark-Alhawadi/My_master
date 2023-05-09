<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Order_item;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class StripeController extends Controller
{
    public function StripeOrder(Request $request){
        $user_id = Auth::user()->id;
        
        if($request->notes){
             $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'name' => $request->shipping_name,
            'email' => $request->shipping_email,
            'phone' => $request->shipping_phone,
            'adress' => $request->shipping_address,
            'notes' => $request->notes,

            'amount' => $request->amount,
            
            'order_number' => 1,

            'invoice_no' => 'EOS'.mt_rand(10000000,99999999),
            'order_date' => Carbon::now()->format('d F Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'), 
            'status' => 'pending',
            'created_at' => Carbon::now(),  

            'vendor_id' => $request->vendor_id,
            'admin_id' => $request->admin_id,

        ]);
        }else{
            $order_id = Order::insertGetId([
                'user_id' => Auth::id(),
                'name' => $request->shipping_name,
                'email' => $request->shipping_email,
                'phone' => $request->shipping_phone,
                'adress' => $request->shipping_address,
    
                'amount' => $request->amount,
                
                'order_number' => 1,
    
                'invoice_no' => 'EOS'.mt_rand(10000000,99999999),
                'order_date' => Carbon::now()->format('d F Y'),
                'order_month' => Carbon::now()->format('F'),
                'order_year' => Carbon::now()->format('Y'), 
                'status' => 'pending',
                'created_at' => Carbon::now(),  

                'vendor_id' => $request->vendor_id,
                'admin_id' => $request->admin_id,
            ]);
        }

       

        $carts = Cart::where('user_id',$user_id)->get();
        foreach($carts as $cart){

            Order_item::insert([
                'order_id' => $order_id,
                'product_id' => $cart->product_id,
                'price' => $request->amount,
                'created_at' =>Carbon::now(),
                'vendor_id' => $request->vendor_id,
                'admin_id' => $request->admin_id,

            ]);

        } // End Foreach
       
        $CartDelete = Cart::where('user_id', $user_id)->delete();
        if ( $CartDelete) {

            $notification = array(
                'message' => 'Your Order Place Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->route('user.order.page')->with($notification); 
        } else {
            return "noo";
        }        

    }
}
