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

class ProductController extends Controller
{
    public function AllProduct(){
        $products = Product::latest()->get();
        return view('backend.product.product_all',compact('products'));
    } //End Method


    public function AddProduct(){
        $activeVendor = User::where('status','active')->where('role','vendor')->latest()->get();
        $categories = Category::latest()->get();
        
        return view('backend.product.product_add',compact('categories','activeVendor'));

    } //End Method


    public function StoreProduct(Request $request){
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
            'vendor_id' => $request->vendor_id,
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

                'product_id' =>$product_id,
                'photo_name' => $uploadPath,
                'created_at' =>Carbon::now(),

            ]);
        } // End foreach
        //// End Multiple Image Upload Form ////

        $notification = array(
            'message' => 'product Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.product')->with($notification);

    } //End Method


    public function EditProduct($id){

        $activeVendor = User::where('status','active')->where('role','vendor')->latest()->get();
        $multiImage = MultiImg::where('product_id',$id)->get();
        $categories = Category::latest()->get();
        $subcategory = SubCategory::latest()->get();
        $products = Product::findOrFail($id);

        return view('backend.product.product_edit',compact('activeVendor','products','categories','subcategory','multiImage'));

    } //End Method


    public function UpdateProduct(Request $request) {
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

            'vendor_id' => $request->vendor_id,
            'status' => 1,
            'created_at' =>Carbon::now(),

        ]);

       
        $notification = array(
            'message' => 'Product Updated Without Image Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.product')->with($notification);


    } //End Method


    public function UpdateProductThambnail(Request $request) {
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
            'message' => 'Product Updated Image Thambnail Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.product')->with($notification);

    } //End Method


    //multi image update
    public function UpdateProductMultiImage(Request $request) {
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
            'message' => 'Product Updated Multi Image Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 

    } //End Method


    public function MultiImageDelete($id) {
        $oldImg =  MultiImg::findOrFail($id);
        $img = $oldImg->photo_name;
        unlink($img);

        $oldImg->delete();

        $notification = array(
            'message' => 'Product Deleted Multi Image Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } //End Method


    public function ProductInactive($id) {
        Product::findOrFail($id)->update(['status' => 0]);

        $notification = array(
            'message' => 'Product Inactive',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } //End Method


    public function ProductActive($id) {
        Product::findOrFail($id)->update(['status' => 1]);

        $notification = array(
            'message' => 'Product Active',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } //End Method


    public function DeleteProduct($id) {
        $product = Product::findOrFail($id);
        unlink($product->product_thambnail);
        $product->delete();

        $images = MultiImg::where('product_id',$id)->get();
        foreach($images as $img){
            unlink($img->photo_name);
            MultiImg::where('product_id',$id)->delete();
        }

        $notification = array(
            'message' => 'Product Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } //End Method

}
