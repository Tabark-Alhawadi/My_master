<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\MultiImg;
use App\Models\Product;
use App\Models\User;
use Image;
use Carbon\Carbon;
use Auth;

class VendorProductController extends Controller
{
    public function VendorAllProduct(){

        $id = Auth::user()->id;
        $products = Product::where('vendor_id',$id)->latest()->get();
        return view('vendor.backend.product.vendor_product_all',compact('products'));

    } //End Method


    public function VendorAddProduct(){

        $categories = Category::latest()->get();
        
        return view('vendor.backend.product.vendor_product_add',compact('categories'));

    } //End Method

    
    public function VendorGetSubCategory($category_id){

        $subcat = SubCategory::where('category_id',$category_id)->orderBy('subcategory_name','ASC')->get();
        return json_encode($subcat);

    } //End Method


    public function VendorStoreProduct(Request $request){
        $image = $request->file('product_thambnail');
        $name_gen = hexdec(uniqid()). "." . $image->getClientOriginalExtension();
        $save_url = 'upload/products/thambnail/'.$name_gen ;
        $image->move(public_path('upload/products/thambnail/'),$name_gen);

        $product_id = Product::insertGetId([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'product_name' => $request->product_name,
            'product_slug' => strtolower(str_replace(' ','-',$request->product_name)),

            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags' => $request->product_tags,

            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_descp' => $request->short_descp,
            'long_descp' => $request->long_descp,


            'product_thambnail' =>$save_url,
            'vendor_id' => Auth::user()->id,
            'status' => 1,
            'created_at' =>Carbon::now(),

        ]);

        //// Multiple Image Upload Form Her ////

        $images = $request->file('multi_img');
        
        foreach($images as $img) {
            $make_name = hexdec(uniqid()). "." . $img->getClientOriginalExtension();
            $img->move(public_path('upload/products/multi-img/'),$make_name);
            $uploadPath = 'upload/products/multi-img/'.$make_name ;

            MultiImg::insert([ 

                'product_id' => $product_id,
                'photo_name' => $uploadPath,
                'created_at' => Carbon::now(),

            ]);
        } // End foreach
        //// End Multiple Image Upload Form ////

        $notification = array(
            'message' => 'Vendor Product Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('vendor.all.product')->with($notification);

    } //End Method


    public function VendorEditProduct($id){

       
        $multiImage = MultiImg::where('product_id',$id)->get();
        $categories = Category::latest()->get();
        $subcategory = SubCategory::latest()->get();
        $products = Product::findOrFail($id);

        return view('vendor.backend.product.vendor_product_edit',compact('products','categories','subcategory','multiImage'));

    } //End Method


    public function VendorUpdateProduct(Request $request) {
        $product_id = $request->id ;

        Product::findOrFail($product_id)->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'product_name' => $request->product_name,
            'product_slug' => strtolower(str_replace(' ','-',$request->product_name)),

            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags' => $request->product_tags,

            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_descp' => $request->short_descp,
            'long_descp' => $request->long_descp,


            'status' => 1,
            'created_at' =>Carbon::now(),

        ]);

       
        $notification = array(
            'message' => 'Vendor Product Updated Without Image Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('vendor.all.product')->with($notification);


    } //End Method


    public function VendorUpdateProductThambnail(Request $request) {
        $pro_id = $request->id;
        $oldImage = $request->old_img;

        $image = $request->file('product_thambnail');
        $name_gen = hexdec(uniqid()). "." . $image->getClientOriginalExtension();
        $save_url = 'upload/products/thambnail/'.$name_gen ;
        $image->move(public_path('upload/products/thambnail/'),$name_gen);

        
        if (file_exists($oldImage)){
            unlink($oldImage);
        }

        Product::findOrFail($pro_id)->update([
            'product_thambnail' => $save_url,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Vendor Product Updated Image Thambnail Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('vendor.all.product')->with($notification);

    } //End Method


     //multi image update
     public function VendorUpdateProductMultiImage(Request $request) {
        $imgs = $request->multi_img;

        foreach ($imgs as $id => $img) {
            $imgDel = MultiImg::findOrFail($id);
            unlink($imgDel->photo_name);

            $make_name = hexdec(uniqid()). "." . $img->getClientOriginalExtension();
            $img->move(public_path('upload/products/multi-img/'),$make_name);
            $uploadPath = 'upload/products/multi-img/'.$make_name ;

            MultiImg::where('id',$id)->update([
                'photo_name' => $uploadPath,
                'updated_at' =>Carbon::now(),
            ]);
        }// end foreach


        $notification = array(
            'message' => 'Vendor Product Updated Multi Image Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 

    } //End Method


    public function VendorMultiImageDelete($id) {
        $oldImg =  MultiImg::findOrFail($id);
        $img = $oldImg->photo_name;
        unlink($img);

        $oldImg->delete();

        $notification = array(
            'message' => 'Vendor Product Deleted Multi Image Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } //End Method


    public function VendorProductInactive($id) {
        Product::findOrFail($id)->update(['status' => 0]);

        $notification = array(
            'message' => 'Product Inactive',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } //End Method


    public function VendorProductActive($id) {
        Product::findOrFail($id)->update(['status' => 1]);

        $notification = array(
            'message' => 'Product Active',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } //End Method


    public function VendorDeleteProduct($id) {
        $product = Product::findOrFail($id);
        unlink($product->product_thambnail);
        $product->delete();

        $images = MultiImg::where('product_id',$id)->get();
        foreach($images as $img){
            unlink($img->photo_name);
            MultiImg::where('product_id',$id)->delete();
        }

        $notification = array(
            'message' => 'Vendor Product Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } //End Method


}
