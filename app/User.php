<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Program;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name','last_name','dob','gender','nationality','type', 'email', 'password','mobile','institution_name','occupation','roll','status','email_verified_at','editor_roll','assigned_program','otp','verified'];


    protected $appends = ['assigned_program_names'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];




     public function getAssignedProgramAttribute($value)
    {
        return explode(",", $value);
    }


    public function getAssignedProgramNamesAttribute($value)
    {
        return Program::whereIn('id', $this->assigned_program )->get();
    }


    public function verifyUser()
    {
        return $this->hasOne('App\VerifyUser');
    }


    public function childrens(){
           return $this->hasMany('App\Children','parent_id');
       }

    public function subscriptions(){
       return $this->hasMany('App\Subscription','parent_id');
   }
}
