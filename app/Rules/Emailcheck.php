<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\User;

class Emailcheck implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public $id;
    public $roll;
    public $message;
    public function __construct($roll,$id=false)
    {
        $this->id = $id;
        $this->roll = $roll;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {   
        if(! $this->id){
            $user = User::where('email',$value)->where('roll',$this->roll)->first();
        }else{
            $user = User::where('email',$value)->where('roll',$this->roll)->where('id','!=',$this->id)->first();
        }
        if(! filter_var($value,FILTER_VALIDATE_EMAIL)){
            $this->message = "Invalid email address";
        }else if($user){
            $this->message = "This email address is already registered with us";
        }
        
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {   
        return $this->message;
    }
}
