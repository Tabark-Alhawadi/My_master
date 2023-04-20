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
    public function Index() {
        $skip_category_0 = Category::skip(0)->first();
        $skip_product_0 = Product::where('status',1)->where('category_id',$skip_category_0->id)->orderBy('id','DESC')->limit(5)->get();

        $skip_category_2 = Category::skip(2)->first();
        $skip_product_2 = Product::where('status',1)->where('category_id',$skip_category_2->id)->orderBy('id','DESC')->limit(5)->get();
        
        $skip_category_7 = Category::skip(7)->first();
        $skip_product_7 = Product::where('status',1)->where('category_id',$skip_category_7->id)->orderBy('id','DESC')->limit(5)->get();

        
        return view('frontend.index',compact('skip_category_0','skip_product_0','skip_category_2','skip_product_2','skip_category_7','skip_product_7','HotDeals','SpecialOffer','SpecialDeals','new'));

    }


    public function ProductDetails($id,$slug){
        $product = Product::findOrFail($id);
 
        $multiImg = MultiImg::where('product_id',$id)->get();

        $relatedProduct = Product::where('id','!=',$id)->orderBy('id','DESC')->limit(4)->get();
        return view('frontend.product.product_details',compact('product','multiImg','relatedProduct'));

    } // End Method
}
