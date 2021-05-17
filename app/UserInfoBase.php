<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInfoBase extends Model
{
    //
    protected $guarded=[];
    //
    public function infos(){
        return $this->hasMany('App\UserInfo','base_id');
    }
    //
    public function users()
    {
        return $this->belongsToMany(
            'App\User','user_user_info_base','user_info_base_id','user_id'
        );
    }
}
