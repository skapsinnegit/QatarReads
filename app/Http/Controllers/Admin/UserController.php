<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\User;

class UserController extends Controller
{
    public function listUser()
    {
    	$users = User::where('roll',3)->get();
    	return view('admin.listUser',compact('users'));
    }


    public function viewUsers($id){
    	$user = User::find(decrypt($id));
    	return view('admin.viewUsers',compact('user'));
    }


    public function activeInactive($id){
    	$user = User::where('id',decrypt($id))->first();
    	$status = $user->status==1 ? 0 : 1;
    	User::where('id',decrypt($id))->update(['status'=>$status]);
        return Redirect::back()->withErrors(array("msg"=>"User Status Updated Successfully","class"=>"alert-success"));

    }

}