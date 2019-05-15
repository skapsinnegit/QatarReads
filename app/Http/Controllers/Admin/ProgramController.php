<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Validator;
use App\Program;

class ProgramController extends Controller
{


   protected function dataExist($id){
        $data = Program::find(decrypt($id));
        abort_if($data == null, 404);
    }


    public function listProgram()
    {
        if(Auth::user()->editor_roll==1 || empty(Auth::user()->assigned_program[0])){
            $programs = Program::all();
        }else{ 
            $programs = Auth::user()->assigned_program_names;
        }
    	return view('admin.listProgram',compact('programs'));
    }



     public function addProgram(){
        if(Auth::user()->editor_roll==2){
           return Redirect::route('admin.listProgram');
        }
    	return view('admin.addProgram');
    }


      public function addProgramPost (Request $request){
        if(Auth::user()->editor_roll==2){
           return Redirect::route('admin.listProgram');
        }
    	 $validator = Validator::make($request->all(), [
            'name' => 'bail|required|string',
            'start_age' => 'bail|required|integer',
            'end_age' => 'bail|required|integer',
            'cost' => 'bail|required|numeric',
            'recurring_cost' => 'bail|required|numeric',
            'max_subscription' => 'bail|required|integer',
        ],[
            "name.required" => "Name is required",
        ]);

    	 if($validator->fails()){
    		return Redirect::back()->withInput()->withErrors($validator->messages());
        }else{
            $input = $request->all();
            $program = Program::create($input);
            if(!empty($program)){
		       return Redirect::route('admin.listProgram')->withErrors(array("msg"=>"Program has been successfully added!","class"=>"alert-success"));
		      }else{
		         return Redirect::back()->withErrors(array("msg"=>"Something went wrong, Try again.","class"=>"alert-danger"));
		      }
        }
    }


    public function editProgram(Request $request,$id){
        if(Auth::user()->editor_roll==2 && ! in_array(decrypt($id), Auth::user()->assigned_program)){
           return Redirect::route('admin.listProgram');
        }
        $this->dataExist($id);
        $program = Program::find(decrypt($id));
        return view('admin.editProgram',compact('program'));
    }


    public function editProgramPost(Request $request,$id){
        if(Auth::user()->editor_roll==2 && ! in_array(decrypt($id), Auth::user()->assigned_program)){
           return Redirect::route('admin.listProgram');
        }
         $this->dataExist($id);
         $validator = Validator::make($request->all(), [
            'name' => 'bail|required|string',
            'start_age' => 'bail|required|integer',
            'end_age' => 'bail|required|integer',
            'cost' => 'bail|required|numeric',
            'recurring_cost' => 'bail|required|numeric',
            'max_subscription' => 'bail|required|integer',
        ],[
            "name.required" => "Name is required",
        ]);

         if($validator->fails()){
            return Redirect::back()->withInput()->withErrors($validator->messages());
        }else{
            $input = $request->all();
            unset($input['_token']);
            $program = Program::where('id',decrypt($id))->update($input);
            if(!empty($program)){
               return Redirect::route('admin.listProgram')->withErrors(array("msg"=>"Program has been successfully Updated!","class"=>"alert-success"));
              }else{
                 return Redirect::back()->withErrors(array("msg"=>"Something went wrong, Try again.","class"=>"alert-danger"));
              }
        }

    }


    public function activeInactive($id){
        if(Auth::user()->editor_roll==2 && ! in_array(decrypt($id), Auth::user()->assigned_program)){
           return Redirect::route('admin.listProgram');
        }
        $user = Program::where('id',decrypt($id))->first();
        $status = $user->status==1 ? 0 : 1;
        Program::where('id',decrypt($id))->update(['status'=>$status]);
        return Redirect::back()->withErrors(array("msg"=>"Program Status Updated Successfully","class"=>"alert-success"));

    }


    public function deleteProgram($id){
        if(Auth::user()->editor_roll==2 && ! in_array(decrypt($id), Auth::user()->assigned_program)){
           return Redirect::route('admin.listProgram');
        }
        $this->dataExist($id);
        $program = Program::find(decrypt($id)); 
        $program->delete();
        return redirect()->back()->withErrors(array("msg"=>"Program has been successfully Deleted","class"=>"alert-success"));
    }


}