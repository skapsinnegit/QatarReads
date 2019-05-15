<?php

use App\Subscription;

function checksubscription($programId,$status=1){
        $check = Subscription::where('parent_id',Auth::user()->id)->where('program_id',$programId)->first();
        $res = new stdClass();
        if($check){
            $res->status= true;
            $res->value = $check->status;
        }else{
            $res->status = false;
            $res->value = false;
        }

        return $res;
    }


function subscriptionDetails($programId){
   return $sub = Subscription::where('parent_id',Auth::user()->id)->where('program_id',$programId)->first();
}

