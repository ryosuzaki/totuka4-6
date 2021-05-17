<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    //
    protected $guarded=[];
    //
    protected $casts = [
        'info'  => 'json',
    ];
    //
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
    //
    public function base(){
        return $this->belongsTo('App\UserInfoBase','base_id');
    }
}
