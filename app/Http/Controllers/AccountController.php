<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\User;
use App\VerifyUser;
use App\Mail\VerifyMail;
use App\Mail\WelcomeMail;
use App\Mail\OtpMail;
use Mail;
use Session;
use App\Rules\Emailcheck;

class AccountController extends Controller
{

    public function postSignUp(Request $request){
        
         $validator = Validator::make($request->all(), [
            'first_name' => 'bail|required|string',
            'last_name' => 'bail|required|string',
            'email' => [new Emailcheck(3)],
            'mobile' => 'bail|required|integer|unique:users',
            'nationality' => 'bail|required|string',
            'gender' => 'bail|required',
            'type' => 'bail|required',
            'occupation' => 'bail|sometimes|nullable|required_if:type,"Institution"|string',
            'institution_name' => 'bail|sometimes|nullable|required_if:type,"Institution"|string',
            'password' => 'bail|required|min:8|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'password_confirmation' => 'bail|required|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
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
            "password.regex" => "Password atleast 8 characters long, Should contain atleat 1 Uppercase, 1 Lowercase, 1 Numeric and 1 Special Character",
            "password_confirmation.regex" => "Confirm Password atleast 8 characters long, Should contain atleat 1 Uppercase, 1 Lowercase, 1 Numeric and 1 Special Character"
        ]);


        if($validator->fails()){
            return Redirect::back()->withInput()->withErrors($validator->messages());
        }else{
            $input = $request->all();
            $input['roll'] = 3;
            $input['password'] = Hash::make($input['password']);
            $user = User::create($input);
            if(!empty($user)){
                $verifyUser = VerifyUser::create([
                    'user_id' => $user->id,
                    'token' => str_random(40)
                ]);
            Mail::to($user->email)->send(new VerifyMail($user));
               return Redirect::back()->withErrors(array("msg"=>"You Have Been Successfully Registered!, Please Verify Your Email to Continue.","class"=>"alert-success"));
              }else{
                 return Redirect::back()->withErrors(array("msg"=>"Something went wrong, Try again.","class"=>"alert-danger"));
              }
        }
    }


    public function verifyUser($token)
    {
        $verifyUser = VerifyUser::where('token', $token)->first();
        if(isset($verifyUser) ){
            $user = $verifyUser->user;
            if(!$user->verified) {
                $verifyUser->user->verified = 1;
                $verifyUser->user->save();
                $status = "Your e-mail is verified. You can now login.";
                Mail::to($user->email)->send(new WelcomeMail($user));
            }else{
                $status = "Your e-mail is already verified. You can now login.";
            }
        }else{
            return redirect('/sign-in')->withErrors(array("msg"=>"Sorry your email cannot be identified.","class"=>"alert-danger")); 
        }

        return redirect('/sign-in')->withErrors(array("msg"=>$status,"class"=>"alert-success"));
    }


    public function resendVerfication(){
        return view('resendVerification');
    }


    public function resendVerficationPost(Request $request){
        $email = $request->get('email');
        $user = User::where('email',$email)->first();
        if($user){

            $isToken = VerifyUser::where('user_id', $user->id)->first();
            if(! $isToken){
                $verifyUser = VerifyUser::create([
                    'user_id' => $user->id,
                    'token' => str_random(40)
                ]);
            }
             
            Mail::to($user->email)->send(new VerifyMail($user));
            return Redirect::back()->withErrors(array("msg"=>"Verification code has been successfully sent to your email address","class"=>"alert-success"));
        }else{
            return Redirect::back()->withErrors(array("msg"=>"Given email address is not registred with us","class"=>"alert-danger"));
        }
    }



    public function postSignIn(Request $request){

        $username = $request->get('email');
        $password = $request->get('password');

        if($request->get('logtype')=="user"){ 
            $check =  Auth::attempt(['email' => $username, 'password' => $password,'verified'=>1,'status'=>1,"roll"=>3]);
            $rolls = array(3);
        }else{
            $check =  Auth::attempt(['email' => $username, 'password' => $password,'verified'=>1,'status'=>1,"roll"=>[1,2]]);
            $rolls = array(1,2);
        }
        	if($check){
        		User::where('email', $username)->whereIn('roll',$rolls)->update(['fail_attempt' => 0]);
	            $user = User::where("email", $username)->whereIn('roll',$rolls)->first();
                if($user->roll==1 || $user->roll==2){
                    if($request->get('logtype')=="user"){
                        Auth::logout();
                        return Redirect::back()->withErrors(array("msg"=>"Username or Password is Wrong","class"=>"alert-danger"));
                    }
                    $otp = mt_rand(100000, 999999);
                    $user->otp = $otp;
                    $user->save();
                    $id = $user->id;
                    Mail::to($user->email)->send(new OtpMail($user,$otp));
                    return redirect()->route('validateOtp')->with(['id' => $id]);
                }else{
                    if($request->get('logtype')=="admin"){
                        Auth::logout();
                        return Redirect::back()->withErrors(array("msg"=>"Username or Password is Wrong","class"=>"alert-danger"));
                    }
                    $redirect = $this->loginRedirect($user->roll);
                    return redirect()->route($redirect);
                }
	            
        	}else{
                $emailVerify = false;
        		$user = User::where("email", $username)->whereIn('roll',$rolls)->first();
	            if ($user != null){
                    if($user->verified==0){
                        $msg = 'Please verify your email Address';
                        $emailVerify = true;
                    }else if($user->status==0){
                        $msg = 'You account suspended. Contact administrator.';
                    }else{
                        $user->increment('fail_attempt');
                        if ($user->fail_attempt == 5){
                            $user->status = 0;
                            $user->save();
                            $msg = 'You account suspended. Contact administrator.';
                        }
                        elseif ($user->fail_attempt > 5)
                            $msg = 'You account suspended. Contact administrator.';
                        else{
                            $msg = sprintf("Invalid login credentials.\r\n Attempt remaining %s", 5 - $user->fail_attempt);
                        }
                    }
	            }else{
	                $msg = 'Username or Password is Wrong';
	            }
        		return Redirect::back()->withErrors(array("msg"=>$msg,"class"=>"alert-danger","verify"=>$emailVerify));
        	}
    }


    public function validateOtp(Request $request){
        if(! Session::get('id')){
            Auth::logout();
            return Redirect::route('admin.login');
        }else{
            Auth::logout();
            $id = encrypt(Session::get('id'));
            return view('validateOtp',compact('id'));
        }
    }

    public function validateOtpPost(Request $request){
        $user = User::where('id',decrypt($request->get('id')))->where('otp',$request->get('otp'))->first();
        if($user){
            User::where('id',$user->id)->update(['otp'=>NULL]);
            Auth::loginUsingId($user->id);
            return redirect()->route('admin.index');
        }else{
            User::where('id',decrypt($request->get('id')))->update(['otp'=>NULL]);
            return Redirect::route('admin.login')->withErrors(array("msg"=>"You Have Entered Invalid Otp","class"=>"alert-danger"));
        }
    }


    public function profileUpdate(){
        $user = User::where('id',Auth::user()->id)->first();
        return view('profileUpdate',compact('user'));
    }

    public function profileUpdatePost(Request $request){
        $validator = Validator::make($request->all(), [
            'first_name' => 'bail|required|string',
            'last_name' => 'bail|required|string',
            'email' => [new Emailcheck(3,Auth::user()->id)],
            'mobile' => 'bail|required|integer|unique:users,mobile,'.Auth::user()->id,
            'nationality' => 'bail|required|string',
            'gender' => 'bail|required',
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
            $user = User::where('id',Auth::user()->id)->update([
                'first_name' => $input['first_name'] ,
                'last_name' => $input['last_name'] ,
                'email' => $input['email'] ,
                'mobile' => $input['mobile'] ,
                'nationality' => $input['nationality'] ,
                'gender' => $input['gender'] ,
            ]);
            if(!empty($user)){
               return Redirect::back()->withErrors(array("msg"=>"Profile updated Successfully!","class"=>"alert-success","alert"=>true));
              }else{
                 return Redirect::back()->withErrors(array("msg"=>"Something went wrong, Try again.","class"=>"alert-danger"));
              }
        }
    }



    public function updatePassword(Request $request){
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



    public function loginRedirect($roll){
    	if($roll==1){
    		$url = 'admin.index';
    	}else if($roll==2){
    		$url = 'admin.index';
    	}if($roll==3){
    		$url = 'dashboard';
    	}

    	return $url;
    }

    public function logout(){
        $roll = Auth::user()->roll;
    	Auth::logout();
        if($roll==1 || $roll==2){
            return redirect()->route("admin.login");
        }else{
            return redirect()->route("signIn");
        }
        
    }
}
