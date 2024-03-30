<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function show_profile(){
        if (Session::has('user_id')) {
            $user_id = Session::get('user_id');
        
            $account = User::where('id', $user_id)->first();
    
            return view('User.userprofile', compact('account'));
    } else {
        
        return redirect()->route('login');
    }
       
    }
    public function resetPassword(Request $request)
{
    $request->validate([
        'password' => 'required|string|min:4',
    ]);

    $user_id = Session::get('user_id');

    if (!$user_id) {
        return response()->json('User not found.',404);
    }

    $user_data = User::where('id',$user_id)->first();

    $user_data->password = bcrypt($request->password);
    $user_data->save();

    return response()->json('Password has been reset successfully.',200);
}
public function updateAccount(Request $request){
$request->name;
$request->email;

$user_id = Session::get('user_id');
$account = User::where('id',$user_id)->first();

$account->name = $request->name;
$account->email = $request->email;
$account->save();

return response()->json('Account has been Updated',200);
}
}
