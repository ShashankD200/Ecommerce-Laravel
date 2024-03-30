<?php

namespace App\Http\Controllers;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AddressController extends Controller
{
    public function add_address(Request $request){
        $user_id = Session::get("user_id");

        $request->validate([
            'line_1' => 'required|string|max:255',
            'line_2' => 'nullable|string|max:255',
            'pincode' => 'required|string|max:10', 
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'mobile' => 'required|string|size:10', 
        ]);
    
        
        $address = new Address();
        $address->user_id = $user_id;
        $address->line_1 = $request->line_1;
        $address->line_2 = $request->line_2;
        $address->pincode = $request->pincode;
        $address->state = $request->state;
        $address->city = $request->city;
        $address->mobile = $request->mobile;
    
       
        $address->save();
    
       
        return response()->json(['message' => 'Address added successfully']);
    }
}
