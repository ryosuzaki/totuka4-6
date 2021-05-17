<?php

namespace App\Models\Group;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //
    protected $guarded = [];

    //
    public function users(){
        return $this->belongsToMany(
            'App\User','group_members','group_id','user_id'
        );
    }
    //
    public function roles(){
        return $this->hasMany('App\Models\Group\GroupRole','group_id');
    }
    //
    public function infos(){
        return $this->hasMany('App\Models\Group\GroupInfo','group_id');
    }
    //
    public function infoBases(){
        return $this->belongsToMany(
            'App\Models\Group\GroupInfoBase','group_group_info_base','group_id','group_info_base_id'
        );
    }

}
