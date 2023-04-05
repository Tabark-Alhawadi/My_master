<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Image;

class CategoryController extends Controller
{
    public function AllCategory(){
        $Categories = Category::latest()->get();
        return view('backend.category.category_all',compact('Categories'));
    } //End Method


    public function AddCategory(){
        return view('backend.category.category_add');
    } //End Method


    public function StoreCategory(Request $request){
        $image = $request->file('category_image');
        $name_gen = hexdec(uniqid()). "." . $image->getClientOriginalExtension();
        // Image::make($image)->resize(300,300)->save('upload/category'.$name_gen);
        $save_url = 'upload/category/'.$name_gen ;
        $image->move(public_path('upload/category'),$name_gen);

        Category::insert([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-',$request->category_name)),
            'category_image' => $save_url,
        ]);

        $notification = array(
            'message' => 'Category Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.category')->with($notification);
 
    } //End Method

    
    public function EditCategory($id){
        $category = Category::findOrFail($id);
        return view('backend.category.category_edit',compact('category'));
    } //End Method


    public function UpdateCategory(Request $request) {
        $category_id = $request->id;
        $old_img = $request->old_image;

        if($request->file('category_image')){

            $image = $request->file('category_image');
            $name_gen = hexdec(uniqid()). "." . $image->getClientOriginalExtension();
            $save_url = 'upload/category/'.$name_gen ;
            $image->move(public_path('upload/category'),$name_gen);
    
            if (file_exists($old_img)){
                unlink($old_img);
            }


            Category::findOrFail($category_id)->update([
                'category_name' => $request->category_name,
                'category_slug' => strtolower(str_replace(' ', '-',$request->category_name)),
                'category_image' => $save_url,
            ]);
    
            $notification = array(
                'message' => 'Category Updated With Image Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->route('all.category')->with($notification);


        }else {
            Category::findOrFail($category_id)->update([
                'category_name' => $request->category_name,
                'category_slug' => strtolower(str_replace(' ', '-',$request->category_name)),
            ]);
    
            $notification = array(
                'message' => 'Category Update Without Image Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->route('all.category')->with($notification);

        }

   } //End Method


   public function DeleteCategory($id){

    $category =  Category::findOrFail($id);
    $img = $category->category_image;

    unlink($img);
    $category->delete();

    $notification = array(
        'message' => 'Category Deleted Successfully',
        'alert-type' => 'success'
    );

    return redirect()->back()->with($notification);
   } //End Method

}
