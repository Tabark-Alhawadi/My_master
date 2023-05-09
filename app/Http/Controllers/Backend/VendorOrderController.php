<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Order_item;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Auth;

class VendorOrderController extends Controller
{
    public function VendorPendingOrder() {
        $id = Auth::user()->id;
        $orders = Order::where('status','pending')->where('vendor_id',$id)->orderBy('id','DESC')->get();
        $orderItem = Order_item::with('order')->where('vendor_id',$id)->orderBy('id','DESC')->get();
        return view('vendor.backend.orders.vendor_pending_order',compact('orderItem','orders'));

    } // End Method


    public  function VendorOrderDetails($order_id) {
        
        $order = Order::where('id',$order_id)->first();
        $orderItem = Order_item::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();

        return view('vendor.backend.orders.vendor_order_details',compact('order','orderItem'));

    } // End Method


    public function VendorDeliveredOrder(){
        $id = Auth::user()->id;
        $orders = Order::where('status','deliverd')->where('vendor_id',$id)->orderBy('id','DESC')->get();
        $orderItem = Order_item::with('order')->where('vendor_id',$id)->orderBy('id','DESC')->get();
        return view('vendor.backend.orders.vendor_delivered_order',compact('orders','orderItem'));
    } // End Method 


    public function VendorProcessToDelivered($order_id){

        $product = Order_item::where('order_id',$order_id)->get();
        foreach($product as $item){
            Product::where('id',$item->product_id)
            ;
        } 

        Order::findOrFail($order_id)->update(['status' => 'deliverd']);

        $notification = array(
            'message' => 'Order Deliverd Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('vendor.delivered.order')->with($notification); 


    } // End Method 


    public function VendorInvoiceDownload($order_id){

        $order = Order::where('id',$order_id)->first();
        $orderItem = Order_item::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();

        $pdf = Pdf::loadView('vendor.backend.orders.vendor_order_invoice', compact('order','orderItem'))->setPaper('a4')->setOption([
                'tempDir' => public_path(),
                'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');

    } // End Method 

}
