<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function AdminDashboard(){
        return view('admin.index');
    }//End Method

    public function AdminLogin(){
        return view('admin.admin_login');
    }//End Method

    public function AdminDestroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }//End Method

    public function AdminProfile(){

        $id=Auth::user()->id;
        $adminData=User::find($id);

        return view('admin.admin_profile',compact('adminData'));
        // we use compact to creates an array containing variables and their values
        
    }//End Method

    public function AdminProfileStore(Request $request){
 
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name=$request->name;
        $data->email=$request->email;
        $data->phone=$request->phone;
        $data->address=$request->address;


        if($request->file('photo')){
            $file = $request->file('photo');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'),$filename);
            $data['photo'] = $filename;
        }
   //The function GetClientOriginalName() is used to retrieve the file's original name at the time of upload in laravel and that'll only be possible if the data is sent as array and not as a string
        $data->save();

        $nitification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($nitification);

    }//End Method



    public function AdminChangePassword(Request $request){
        return view('admin.admin_change_password');

    }//End Method

    public function AdminUpdatePassword(Request $request){
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


    public function InactiveVendor(){

        $inActiveVendor = User::where('status','inactive')->where('role','vendor')->latest()->get();

        return view('backend.vendor.inactive_vendor',compact('inActiveVendor'));

    }//End Method


    public function ActiveVendor(){

        $ActiveVendor = User::where('status','active')->where('role','vendor')->latest()->get();

        return view('backend.vendor.active_vendor',compact('ActiveVendor'));

    }//End Method


    public function InactiveVendorDetails($id){

        $inactiveVendorDetails = User::findOrFail($id);
        return view('backend.vendor.inactive_vendor_details',compact('inactiveVendorDetails'));

    }//End Method


    public function ActiveVendorApprove(Request $request){

        $vendor_id = $request->id;
        $user = User::findOrFail($vendor_id)->update([
            'status' => 'active',
        ]);

        $nitification = array(
            'message' => 'Vendor Active Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('active.vendor')->with($nitification);

    }//End Method


    public function ActiveVendorDetails($id){

        $activeVendorDetails = User::findOrFail($id);
        return view('backend.vendor.active_vendor_details',compact('activeVendorDetails'));

    }//End Method


    public function InactiveVendorApprove(Request $request){

        $vendor_id = $request->id;
        $user = User::findOrFail($vendor_id)->update([
            'status' => 'inactive',
        ]);

        $nitification = array(
            'message' => 'Vendor Inactive Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('inactive.vendor')->with($nitification);

    }//End Method
}