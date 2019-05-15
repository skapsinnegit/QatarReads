<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Program;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Subscription;
use App\Children;
use App\Mail\SubscribeMail;
use App\Mail\UnsubscribeMail;
use Mail;

class ProgramController extends Controller
{

    protected function dataExist($id){
        $data = Program::find(decrypt($id));
        abort_if($data == null, 404);
    }

     public function listPrograms(){
    	$programs = Program::all();
    	return view('listProgram',compact('programs'));
    }


    public function subscribeForm($id){
        $this->dataExist($id);
        $oldData = Subscription::where('program_id',decrypt($id))->where('parent_id',Auth::user()->id)->first();
        $program = Program::where('id',decrypt($id))->first();
        $childrens = children::where('parent_id',Auth::user()->id)->whereRaw( 'timestampdiff(year, dob, curdate()) between ? and ?', [$program->start_age, $program->end_age] )->count();
        return view('subscribeForm',compact('program','childrens','oldData'));
    }



    public function subscribeFormPost(Request $request,$id){
        $this->dataExist($id);
        $validator = Validator::make($request->all(), [
            'address' => 'bail|required|string',
            'state' => 'bail|required|string',
            'city' => 'bail|required|string',
            'pincode' => 'bail|required|string',
            'country' => 'bail|required|string',
            'language' => 'bail|required|string',
            'monthly_subscription' => 'bail|required',
        ],[
            "address.required" => "Address is required",
        ]);


         if($validator->fails()){
            return Redirect::back()->withInput()->withErrors($validator->messages());
        }else{
            $input = $request->all();
            $input['parent_id'] = Auth::user()->id;
            $input['program_id'] = decrypt($id);

            $programDts = Program::where('id',decrypt($id))->first();
            $childrens = children::where('parent_id',Auth::user()->id)->whereRaw( 'timestampdiff(year, dob, curdate()) between ? and ?', [$programDts->start_age, $programDts->end_age] );

            if($childrens->count()==0){
                return Redirect::back()->withInput()->withErrors(array("msg"=>"No children available for this program","class"=>"alert-danger"));
            }else{

               if( $programDts->subscriptions->where('status',1)->count() >= $programDts->max_subscription ){
                   $status = 2;
               }else{
                    $status = 1;
               }

                $whos = "";
                foreach($childrens->get() as $key=> $chld){
                    if($whos==""){
                        $whos = $chld->id;
                    }else{
                        $whos.= ",".$chld->id;
                    }
                }
                 $input['childrens'] = $whos;
                 $chk = checksubscription(decrypt($id),0);
                 if($chk->status){
                    unset($input['_token']);
                    $input['status'] = $status;
                    Subscription::where('program_id',decrypt($id))->where('parent_id',Auth::user()->id)->update($input);
                    $subscription = true;
                 }else{
                    $input['status'] = $status;
                    $subscription = Subscription::create($input);
                 }
                 
                if(!empty($subscription)){
                   Mail::to(Auth::user()->email)->send(new SubscribeMail(Auth::user(),$status,$programDts));
                   $msg = $status == 1 ? "You have successfully Joined in the program" : "You have successfully Joined in the Waiting List";
                   return Redirect::route('listProgram')->withErrors(array("msg"=>$msg,"class"=>"alert-success","alert"=>true));
                  }else{
                     return Redirect::back()->withErrors(array("msg"=>"Something went wrong, Try again.","class"=>"alert-danger"));
                  }
              }
        }
    }



    public function monthlySubscription($id){
        $details = subscriptionDetails(decrypt($id));
        $status = $details->monthly_subscription == 1 ? 0 : 1;
        Subscription::where('id',$details->id)->update(['monthly_subscription'=>$status]);
        return Redirect::back();
    }


    public function unsubscribe($id){
        $this->dataExist($id);
        $program = Program::where('id',decrypt($id))->first();
        Subscription::where('program_id',decrypt($id))->where('parent_id',Auth::user()->id)->update(['status'=>0]);
        Mail::to(Auth::user()->email)->send(new UnsubscribeMail(Auth::user(),$program));
        return Redirect::back();
    }

  
}
