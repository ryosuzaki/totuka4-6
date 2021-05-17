<?php

namespace App\Models\Group;

use Illuminate\Database\Eloquent\Model;

class GroupInfoBase extends Model
{
    //
    protected $guarded = [];
    
    //
    public function infos(){
        return $this->hasMany('App\Models\Group\GroupInfo','base_id');
    }
    //
    public function groups()
    {
        return $this->belongsToMany(
            'App\Models\Group\Group','group_group_info_base','group_info_base_id','group_id'
        );
    }
}
