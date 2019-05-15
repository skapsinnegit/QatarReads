<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model
{
    use Notifiable;
    use SoftDeletes;


    protected $fillable = ['program_id','parent_id','address','state','city','pincode','country','language','monthly_subscription','status','total','childrens'];



    public function programs(){
    	return $this->belongsTo('App\Program','program_id');
    }


    public function users(){
    	return $this->belongsTo('App\User','parent_id');
    }


     public function getChildrensAttribute($value)
    {
        return explode(",", $value);
    }

}
