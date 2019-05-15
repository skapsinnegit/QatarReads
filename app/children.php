<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Children extends Model
{
	use Notifiable;
    use SoftDeletes;

    protected $fillable = ['parent_id','name','dob','school','gender','institution','terms', 'status'];


    public function users(){
    	return $this->belongsTo('App\User','parent_id');
    }

}
