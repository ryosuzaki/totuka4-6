<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded=[];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
         'remember_token','password'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        
    ];

    //user_info
    public function infos(){
        return $this->hasMany('App\UserInfo','user_id');
    }
    //answer
    public function answers(){
        return $this->hasMany('App\Answer','user_id');
    }
    //members
    public function groups(){
        return $this->belongsToMany(
            'App\Models\Group\Group','group_user','user_id','group_id'
        );
    }
    //
    public function questions(){
        return $this->belongsToMany(
            'App\Models\Questionnaire\Question','user_question','user_id','question_id'
        );
    }
    //
    public function infoBases(){
        return $this->belongsToMany(
            'App\UserInfoBase','user_user_info_base','user_id','user_info_base_id'
        );
    }
}
