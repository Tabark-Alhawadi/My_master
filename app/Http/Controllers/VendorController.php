<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class VendorController extends Controller
{
    public function vendorDashboard(){
        return view('vendor.index');
    }//End Method

    
    public function VendorLogin(){
        return view('vendor.vendor_login');
    }//End Method


    public function VendorDestroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/vendor/login');
    }//End Method


    public function VendorProfile(){

        $id=Auth::user()->id;
        $vendorData=User::find($id);

        return view('vendor.vendor_profile',compact('vendorData'));
        // we use compact to creates an array containing variables and their values
        
    }//End Method


    public function VendorProfileStore(Request $request){
 
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name=$request->name;
        $data->email=$request->email;
        $data->phone=$request->phone;
        $data->address=$request->address;
        $data->vendor_join=$request->vendor_join;
        $data->vendor_short_info=$request->vendor_short_info;


        if($request->file('photo')){
            $file = $request->file('photo');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/vendor_images'),$filename);
            $data['photo'] = $filename;
        }
   //The function GetClientOriginalName() is used to retrieve the file's original name at the time of upload in laravel and that'll only be possible if the data is sent as array and not as a string
        $data->save();

        $nitification = array(
            'message' => 'Vendor Profile Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($nitification);

    }//End Method


    public function VendorChangePassword(Request $request){
        return view('vendor.vendor_change_password');

    }//End Method


    public function VendorUpdatePassword(Request $request){
        //Validation
            $request->validate([
                'old_password' => 'required',
                'new_password' => 'required|confirmed',
            ]);
    
            //Match pass
            if(!Hash::check($request->old_password, auth::user()->password)){
                return back()->with("error","Old password does not match!!");
            }
    
            //update the new password
            User::whereId(auth()->user()->id)->update([
    
                'password' => Hash::make($request->new_password)
            ]);
            return back()->with("status"," Password Change Successfully");
            }//End Method
}
