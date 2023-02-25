<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function vendorDashboard(){
        return view('vendor.index');
    }//End Method
}
