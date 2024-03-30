<?php

namespace App\Http\Controllers;
use App\Models\Product;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{   
    public function main(){
        if(session()->has('is_admin')) {
            return redirect()->route('dashboard');
        }
    
        $products = Product::where('is_allowed',1)->get();
        return view("index", compact('products'));
    }
    
    public function user_check(Request $request)
    {
        
        $email = $request->input('email');
        $password = $request->input('password');
    
        $userData = User::getUserByEmail($email, $password);
    
        if ($userData === 'No email') {
            return response()->json(['message' => 'User is not registered using this Email.'], 404);
        } elseif ($userData === 'Incorrect password') {
            return response()->json(['message' => 'Incorrect password'], 401);
        }elseif($userData->status == 0){
            return response()->json(['message'=>'User has been blocked by administrator'], 401);
        }
    
        $request->session()->put('user_id', $userData->id);
        $request->session()->put('user_email', $userData->email);
    
        if ($userData->is_admin == 1) {
            $request->session()->put('is_admin', 1);
            
        }

      
       
        return response()->json('Logged in Successfully!',200);


        
    
    }
    
    public function user_register(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:4',
        ]);
    
        $user = new User();
        $user->name = $request->full_name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password); // Hash the password before saving
        $user->save();
    
      
        return response()->json('Registration Succesfull !');
    }
    

    public function logout()
    {
        Session::flush();
        return redirect()->route('home');
    }
    
    public function block_user(Request $request)
{
$user_id = $request->user_id;
$user = User::find($user_id);

$user->status = 0;
$user->save();
return response()->json($user->name.' has been blocked',200);
}
    public function reactivate_user(Request $request)
{
$user_id = $request->user_id;
$user = User::find($user_id);

$user->status = 1;
$user->save();
return response()->json($user->name.' has been Activated',200);
}
}
