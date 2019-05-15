<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Children;
use App\Subscription;

class DashboardController extends Controller
{
    public function dashboard(){
    	$children = Children::where('parent_id',Auth::user()->id)->get();
    	$subscriptions = Subscription::where('parent_id',Auth::user()->id)->where('status',1)->orWhere('status',2)->get();
    	return view('dashboard',compact('children','subscriptions'));
    }
}
