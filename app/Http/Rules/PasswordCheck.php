<?php

 namespace App\Rules;
 use Illuminate\Support\Str;
 use Illuminate\Contracts\Validation\Rule;

 class PasswordCheck implements Rule
 {

     public function __construct()
     {
         //
     }

     public function passes($attribute, $value)
     {
         //Checks if a password has at least one lowercase character, at least one number and is at least 8 characters long;
         return Str::of($value)->test('/^(?=.*\d)(?=.*[a-z])(?=.*[a-zA-Z]).{8,}$/');

         //Alternate regex which checks if password has at least one uppercase Character as well as the regex above.
         //^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$
     }

     /**
      * Get the validation error message.
      *
      * @return string
      */
     public function message()
     {
         return 'Password must be at least 8 characters long and contain at least one lowercase character and a number.';
     }
 }