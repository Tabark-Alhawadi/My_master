<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ShipState;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function AddToCart(Request $request, $id) {

        if (Auth::check()) {
            $user = Auth::user();
        }

        $product = Product::findOrFail($id);

        if($request->vendor_id){
            Cart::insert([
                'product_id' => $product->id,
    
                'user_id' => $user->id,
                'name' => $user->name,
                'phone' => $user->phone,
                'address' => $user->address,
                'vendor_id' => $request->vendor_id,
                'admin_id' => $request->admin_id,
            ]);
        }else{
        Cart::insert([
            'product_id' => $product->id,

            'user_id' => $user->id,
            'name' => $user->name,
            'phone' => $user->phone,
            'address' => $user->address,
            'admin_id' => $request->admin_id,
        ]);
        }

        $notification = array(
            'message' => 'Add to Cart Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('home')->with($notification);


        
    }

    
    public function DeleteCart($id){

        $Cart =  Cart::findOrFail($id);

        $Cart->delete();

        $notification = array(
            'message' => 'Cart Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }


    public function MyCart() {
        $user_id = Auth::user()->id;
        $carts = Cart::where('user_id',$user_id)->get();
        return view('frontend.mycart.view_mycart',compact('carts'));
    }

    
    public function CheckoutCreate($AllTotal){

        if(Auth::check()){

            if ($AllTotal > 0) {

                $user_id = Auth::user()->id;
                $carts = Cart::where('user_id',$user_id)->get();
                return view('frontend.checkout.checkout_view',compact('carts','AllTotal'));

            }else {

                $notification = array(
                    'message' => 'Shopping At List One Product',
                    'alert-type' => 'error'
                );
        
                return redirect()->to('/')->with($notification);
            }

        }else {
            $notification = array(
                'message' => 'You Need to Login First',
                'alert-type' => 'error'
            );
    
            return redirect()->route('login')->with($notification);
        }
    }
}
