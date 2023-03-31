<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function UserDashboard(){

        $id = Auth::user()->id;
        $userData = User::find($id);
        return view('index',compact('userData'));

    } // End Method


    public function UserProfileStore(Request $request){
 
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name=$request->name;
        $data->username=$request->username;
        $data->email=$request->email;
        $data->phone=$request->phone;
        $data->address=$request->address;


        if($request->file('photo')){
            $file = $request->file('photo');
            @unlink(public_path('upload/user_images'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'),$filename);
            $data['photo'] = $filename;
        }
   //The function GetClientOriginalName() is used to retrieve the file's original name at the time of upload in laravel and that'll only be possible if the data is sent as array and not as a string
        $data->save();

        $nitification = array(
            'message' => 'User Profile Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($nitification);

    }//End Method


    public function UserLogout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $nitification = array(
            'message' => 'User Logout Successfully',
            'alert-type' => 'success'
        );

        return redirect('/login')->with($nitification);
    }//End Method


    public function UserUpdatePassword (Request $request){
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