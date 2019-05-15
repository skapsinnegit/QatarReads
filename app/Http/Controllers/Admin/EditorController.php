<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Validator;
use App\User;
use App\Program;
use App\Rules\Emailcheck;

class EditorController extends Controller
{

    protected function dataExist($id){
        $data = User::find(decrypt($id));
        abort_if($data == null, 404);
    }


    protected function chkUser(){
        if(Auth::user()->editor_roll==2){
           return Redirect::route('admin.listEditor');
        }
    }


    public function listEditor()
    {   $this->chkUser();
    	$editors = User::where('roll',2)->get();
    	return view('admin.listEditor',compact('editors'));
    }


    public function addEditor(){
        $this->chkUser();
    	$programs = Program::where('status',1)->get();
    	return view('admin.addEditor',compact('programs'));
    }



    public function addEditorPost(Request $request){
        $this->chkUser();
    	 $validator = Validator::make($request->all(), [
            'first_name' => 'bail|required|string',
            'last_name' => 'bail|required|string',
            'email' => [new Emailcheck(2)],
            'mobile' => 'bail|required|integer',
            'editor_roll' => 'bail|required',
            'assigned_program' => 'bail|nullable',
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
            "mobile.required" => "Phone number is required",
            "mobile.integer" => "Phone number must be an integer",
            "mobile.unique" => "Phone number is already registered with us",
            "password.regex" => "Password atleast 8 characters long, Should contain atleat 1 Uppercase, 1 Lowercase, 1 Numeric and 1 Special Character",
            "password_confirmation.regex" => "Confirm Password atleast 8 characters long, Should contain atleat 1 Uppercase, 1 Lowercase, 1 Numeric and 1 Special Character"
        ]);


    	 if($validator->fails()){
            return Redirect::back()->withInput()->withErrors($validator->messages());
        }else{
            $input = $request->all();
            $input['password'] = Hash::make($input['password']);
            $input['verified'] = 1;
            $input['assigned_program'] = $request->get('assigned_program') ? implode(",", $request->get('assigned_program')) : "";
            $input['roll'] = 2;
            $user = User::create($input);
            if(!empty($user)){
               return Redirect::route('admin.listEditor')->withErrors(array("msg"=>"Editor Successfully Created","class"=>"alert-success"));
              }else{
                 return Redirect::back()->withErrors(array("msg"=>"Something went wrong, Try again.","class"=>"alert-danger"));
              }
        }
    }


    public function editEditor(Request $request,$id){
        $this->chkUser();
        $this->dataExist($id);
        $programs = Program::where('status',1)->get();
        $editor = User::find(decrypt($id));
        return view('admin.editEditor',compact('editor','programs'));
    }




     public function editEditorPost(Request $request,$id){
        $this->chkUser();
         $validator = Validator::make($request->all(), [
            'first_name' => 'bail|required|string',
            'last_name' => 'bail|required|string',
            'email' => [new Emailcheck(2,decrypt($id))],
            'mobile' => 'bail|required|integer',
            'editor_roll' => 'bail|required',
            'assigned_program' => 'bail|nullable',
            'password' => 'bail|sometimes|nullable|min:8|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'password_confirmation' => 'bail',
        ],[
            "first_name.required" => "First name is required",
            "first_name.string" => "First name must be a string",
            "last_name.required" => "Last name is required",
            "last_name.string" => "Last name  must be a string",
            "email.required" => "Email is required",
            "email.email" => "Email is invalid",
            "email.unique" => "Email is already registered with us",
            "mobile.required" => "Phone number is required",
            "mobile.integer" => "Phone number must be an integer",
            "mobile.unique" => "Phone number is already registered with us",
            "password.regex" => "Password atleast 8 characters long, Should contain atleat 1 Uppercase, 1 Lowercase, 1 Numeric and 1 Special Character",
            "password_confirmation.regex" => "Confirm Password atleast 8 characters long, Should contain atleat 1 Uppercase, 1 Lowercase, 1 Numeric and 1 Special Character"
        ]);


         if($validator->fails()){
            return Redirect::back()->withInput()->withErrors($validator->messages());
        }else{
            $input = $request->all();
            $input['assigned_program'] = $request->get('assigned_program') ? implode(",", $request->get('assigned_program')) : "";           
             unset($input['_token']);
             unset($input['password_confirmation']);
             if($input['password'] !=""){
                $input['password'] = Hash::make($input['password']);
             }else{
                unset($input['password']);
             }
              
            $user = User::where('id',decrypt($id))->update($input);
            if(!empty($user)){
               return Redirect::route('admin.listEditor')->withErrors(array("msg"=>"Editor Successfully Updated","class"=>"alert-success"));
              }else{
                 return Redirect::back()->withErrors(array("msg"=>"Something went wrong, Try again.","class"=>"alert-danger"));
              }
        }
    }



    public function activeInactive($id){
        $this->chkUser();
        $user = User::where('id',decrypt($id))->first();
        $status = $user->status==1 ? 0 : 1;
        User::where('id',decrypt($id))->update(['status'=>$status]);
        return Redirect::back()->withErrors(array("msg"=>"Editor Status Updated Successfully","class"=>"alert-success"));

    }


    public function deleteEditor($id){
        $this->chkUser();
        $this->dataExist($id);
        $editor = User::find(decrypt($id)); 
        $editor->delete();
        return redirect()->back()->withErrors(array("msg"=>"Editor has been successfully Deleted","class"=>"alert-success"));
    }

}