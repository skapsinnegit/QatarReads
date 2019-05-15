<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Children;
use App\Subscription;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class ChildController extends Controller
{


    protected function dataExist($id){
        $data = Children::find(decrypt($id));
        abort_if($data == null, 404);
    }


    public function listChildren(){
    	$children = Children::where('parent_id',Auth::user()->id)->get();
    	return view('listChildren',compact('children'));
    }


    public function addChildren(){
    	return view('addchildren');
    }

    public function addChildrenPost(Request $request){
    	 $validator = Validator::make($request->all(), [
            'name' => 'bail|required|string',
            'dob' => 'bail|required',
            'school' => 'bail|nullable|string',
            'gender' => 'bail|required',
            'institution' => 'bail|required|string',
            'terms' => 'bail|required',
        ],[
            "name.required" => "Name is required",
        ]);

    	 if($validator->fails()){
    		return Redirect::back()->withInput()->withErrors($validator->messages());
        }else{
            $input = $request->all();
            $input['parent_id'] = Auth::user()->id;
            $user = Children::create($input);
            if(!empty($user)){
		       return Redirect::route('listChildren')->withErrors(array("msg"=>"Child has been successfully added!","class"=>"alert-success","alert"=>true));
		      }else{
		         return Redirect::back()->withErrors(array("msg"=>"Something went wrong, Try again.","class"=>"alert-danger"));
		      }
        }
    }


    public function editChild($id){
        $this->dataExist($id);
    	$child = Children::where('id',decrypt($id))->first();
    	return view('editChildren',compact('child'));
    }


    public function editChildPost(Request $request,$id){
        $this->dataExist($id);
    	$validator = Validator::make($request->all(), [
            'name' => 'bail|required|string',
            'dob' => 'bail|required',
            'school' => 'bail|nullable|string',
            'gender' => 'bail|required',
            'institution' => 'bail|required|string',
        ],[
            "name.required" => "Name is required",
        ]);


        if($validator->fails()){
    		return Redirect::back()->withInput()->withErrors($validator->messages());
        }else{
            $input = $request->all();
           	unset($input['_token']);
            $user = Children::where('id',decrypt($id))->update($input);
            if(!empty($user)){
		       return Redirect::route('listChildren')->withErrors(array("msg"=>"Child has been Updated successfully!","class"=>"alert-success","alert"=>true));
		      }else{
		         return Redirect::back()->withErrors(array("msg"=>"Something went wrong, Try again.","class"=>"alert-danger"));
		     }
        }
    }


    public function deleteChild($id){
        $this->dataExist($id);
        $child = Children::find(decrypt($id)); 
        $subscriptions = Subscription::whereRaw("find_in_set('".decrypt($id)."',childrens)")->where('status',1)->get();
        $child->delete();
        foreach($subscriptions as $subscription){
            if(in_array(decrypt($id),$subscription->childrens)){
                $exData = $subscription->childrens;
                if (($key = array_search(decrypt($id), $exData)) !== false) {
                    unset($exData[$key]);
                }
                $newData = implode(",", $exData);
                $sub = Subscription::find($subscription->id);
                $total = $sub->total - 1;
                $sub->total = $total;
                $sub->childrens = $newData;
                if($total==0){
                    $sub->status = 0;
                }
                $sub->save();
            }
        }
        return redirect()->back()->withErrors(array("msg"=>"Child has been successfully Deleted","class"=>"alert-success"));
    }

}
