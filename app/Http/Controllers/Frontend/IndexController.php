<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\MultiImg;
use App\Models\Product;
use App\Models\User;
use App\Models\Contact;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class IndexController extends Controller
{

    public function Index() {

        $new = Product::where('status',1)->orderBy('id','DESC')->limit(3)->get();
    
        return view('frontend.index',compact('new'));

    } // End Method


    public function ProductDetails($id,$slug){
        $product = Product::findOrFail($id);
 
        $multiImg = MultiImg::where('product_id',$id)->get();

        $cat_id = $product->category_id;
        $relatedProduct = Product::where('category_id',$cat_id)->where('id','!=',$id)->orderBy('id','DESC')->limit(4)->get();
        return view('frontend.product.product_details',compact('product','multiImg','relatedProduct'));

    } // End Method


    public function VendorDetails($id){

        $vendor = User::findOrFail($id);
        $vproduct = Product::where('vendor_id',$id)->get();
        return view('frontend.vendor.vendor_details',compact('vendor','vproduct'));

    } // End Method


    public function VendorAll(){

        $vendors = User::where('status','active')->where('role','vendor')->orderBy('id','DESC')->get();

        return view('frontend.vendor.vendor_all',compact('vendors'));

    } // End Method




    public function CatWiseProduct(Request $request, $id, $slug) {
        
        $products = Product::where('status',1)->where('category_id',$id)->orderBy('id','DESC')->get();
        $categories = Category::orderBy('category_name','ASC')->get();
        $breadcat = Category::where('id',$id)->first();
        $newProduct = Product::orderBy('id','DESC')->limit(3)->get();

        return view('frontend.product.category_view',compact('products','categories','breadcat','newProduct'));

    } // End Method


    public function SubCatWiseProduct(Request $request, $id, $slug) {

        $products = Product::where('status',1)->where('subcategory_id',$id)->orderBy('id','DESC')->get();
        $categories = Category::orderBy('category_name','ASC')->get();
        $breadsubcat = SubCategory::where('id',$id)->first();
        $newProduct = Product::orderBy('id','DESC')->limit(3)->get();

        return view('frontend.product.subcategory_view',compact('products','categories','breadsubcat','newProduct'));

    } // End Method

    public function CategoryAll() {
        $products = Product::where('status',1)->orderBy('id','DESC')->get();
        $categories = Category::orderBy('category_name','ASC')->get();
        $breadcat = Category::first();
        $newProduct = Product::orderBy('id','DESC')->where('status',1)->limit(3)->get();

        return view('frontend.page.page_shop',compact('products','categories','breadcat','newProduct'));

    }


    public function ContactPage() {
        $user = Auth::user();
        return view('frontend.page.page_contact',compact('user'));

    }// End Method

    public function StoreContact(Request $request) {
        if (Auth::id()) {
            Contact::insert([
                'user_id' => Auth::id(),
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'subject' => $request->subject,
                'message' => $request->message,
                'created_at' =>Carbon::now(),
    
            ]);
        } else {
            Contact::insert([
                'user_id' => 1,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'subject' => $request->subject,
                'message' => $request->message,
                'created_at' =>Carbon::now(),
    
            ]);

        }

        $notification = array(
            'message' => 'Thank you for message',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    
    
    }// End Method


    public function ProductSearch(Request $request){

        $request->validate(['search' => "required"]);

        $item = $request->search;
        $categories = Category::orderBy('category_name','ASC')->get();
        $products = Product::where('product_name','LIKE',"%$item%")->get();
        $newProduct = Product::orderBy('id','DESC')->limit(3)->get();
        return view('frontend.product.search',compact('products','item','categories','newProduct'));

    }// End Method
    
    

    public function AboutPage() {
        $user = Auth::user();
        return view('frontend.page.page_aboutus',compact('user'));

    }// End Method
}
