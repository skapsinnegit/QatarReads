<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Program extends Model
{

	use Notifiable;
    use SoftDeletes;


    protected $fillable = ['name','start_age','end_age','cost','recurring_cost','max_subscription','status'];


      public function subscriptions(){
	       return $this->hasMany('App\Subscription','program_id');
	   }
}
