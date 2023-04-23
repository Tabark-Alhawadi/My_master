<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\MultiImg;
use App\Models\Product;
use App\Models\User;


class IndexController extends Controller
{
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
}
