<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class User extends Model
{
   protected $table = 'users';

   /**
    * Retrieve all data of the user by email.
    *
    * @param  string  $email
    * @return mixed
    */
   public static function getUserByEmail($email,$password)
   {
      $user = self::where('email', $email)->first();

      if (!$user) {
         return 'No email'; // Return 'No email' if email does not exist
      }
      if (!Hash::check($password, $user->password)) {
        return 'Incorrect password'; // Return 'Incorrect password' if password doesn't match
     }
    // if ($password !== $user->password) {
    //     return 'Incorrect password'; // Return 'Incorrect password' if password doesn't match
    // }
    

     return $user; 
   }
}
