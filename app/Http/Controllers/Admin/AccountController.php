<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\User;
use Session;
use App\Rules\Emailcheck;

class AccountController extends Controller
{

 

    public function updateProfile(){
        $user = User::where('id',Auth::user()->id)->first();
        return view('admin.profile',compact('user'));
    }

    public function updateProfilePost(Request $request){
        $validator = Validator::make($request->all(), [
            'first_name' => 'bail|required|string',
            'last_name' => 'bail|required|string',
            'email' => [new Emailcheck(2,Auth::user()->id)],
            'mobile' => 'bail|required|integer|unique:users,mobile,'.Auth::user()->id,
        ],[
            "first_name.required" => "First name is required",
            "first_name.string" => "First name must be a string",
            "last_name.required" => "Last name is required",
            "last_name.string" => "Last name  must be a string",
            "email.required" => "Email is required",
            "email.email" => "Email is invalid",
            "email.unique" => "Email is already registered with us",
            "mobile.required" => "Mobile number is required",
            "mobile.integer" => "Mobile number must be an integer",
            "mobile.unique" => "Mobile number is already registered with us",
        ]);


        if($validator->fails()){
            return Redirect::back()->withInput()->withErrors($validator->messages());
        }else{
            $input = $request->all();
            unset($input['_token']);
            $user = User::where('id',Auth::user()->id)->update($input);
            if(!empty($user)){
               return Redirect::back()->withErrors(array("msg"=>"Profile updated Successfully!","class"=>"alert-success","alert"=>true));
              }else{
                 return Redirect::back()->withErrors(array("msg"=>"Something went wrong, Try again.","class"=>"alert-danger"));
              }
        }
    }



    public function changePassword(){
        return view('admin.changePassword');
    }

    public function changePasswordPost(Request $request){

        if (Hash::check($request->get('current_password'), Auth::user()->password)) {
                    $validator = Validator::make($request->all(), [
                        'password' => 'bail|required|min:8|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
                        'password_confirmation' => 'bail|required|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
                    ],[
                        "password.regex" => "Password atleast 8 characters long, Should contain atleat 1 Uppercase, 1 Lowercase, 1 Numeric and 1 Special Character",
                        "password_confirmation.regex" => "Confirm Password atleast 8 characters long, Should contain atleat 1 Uppercase, 1 Lowercase, 1 Numeric and 1 Special Character"
                    ]);

                    if($validator->fails()){
                        return Redirect::back()->withInput()->withErrors($validator->messages());
                    }else{
                        User::where('id',Auth::user()->id)->update(['password'=>Hash::make($request->get('password'))]);
                        return Redirect::back()->withErrors(array("msg"=>"Password Updated","class"=>"alert-success"));
                    }
        }else{
            return Redirect::back()->withErrors(array("msg"=>"Current Password is Wrong","class"=>"alert-danger"));
        }

    }


}
