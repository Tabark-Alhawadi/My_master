<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Image;


class SliderController extends Controller
{
    public function AllSlider(){

        $sliders = Slider::latest()->get();
        return view('backend.slider.slider_all',compact('sliders'));

    } //End Method


    public function AddSlider(){

        return view('backend.slider.slider_add');

    } //End Method


    public function StoreSlider(Request $request){

        $image = $request->file('slider_image');
        $name_gen = hexdec(uniqid()). "." . $image->getClientOriginalExtension();
        $save_url = 'upload/slider/'.$name_gen ;
        $image->move(public_path('upload/slider'),$name_gen);

        Slider::insert([
            'slider_title' => $request->slider_title,
            'short_title' => $request->short_title,
            'slider_image' => $save_url,
        ]);

        $notification = array(
            'message' => 'Slider Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.slider')->with($notification);

    } //End Method


    public function EditSlider($id){

        $slider = Slider::findOrFail($id);
        return view('backend.slider.slider_edit',compact('slider'));

    } //End Method


   public function UpdateSlider(Request $request) {

        $slider_id = $request->id;
        $old_img = $request->old_image;

        if($request->file('slider_image')){

            $image = $request->file('slider_image');
            $name_gen = hexdec(uniqid()). "." . $image->getClientOriginalExtension();
            $save_url = 'upload/slider/'.$name_gen ;
            $image->move(public_path('upload/slider'),$name_gen);
    
            if (file_exists($old_img)){
                unlink($old_img);
            }


            Slider::findOrFail($slider_id)->update([
                'slider_title' => $request->slider_title,
                'short_title' => $request->short_title,
                'slider_image' => $save_url,
            ]);
    
            $notification = array(
                'message' => 'slider Updated With Image Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->route('all.slider')->with($notification);


        }else {
            Slider::findOrFail($slider_id)->update([
                'slider_title' => $request->slider_title,
                'short_title' => $request->short_title,
            ]);
    
            $notification = array(
                'message' => 'slider Update Without Image Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->route('all.slider')->with($notification);

        }

   }  //End Method


    public function DeleteSlider($id){

        $slider =  Slider::findOrFail($id);
        $img = $slider->slider_image;

        unlink($img);
        $slider->delete();

        $notification = array(
            'message' => 'slider Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } //End Method
}
