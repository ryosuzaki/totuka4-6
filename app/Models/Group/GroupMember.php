<?php

namespace App\Models\Group;

use Illuminate\Database\Eloquent\Model;

class GroupMember extends Model
{
    //
    protected $guarded=[];
    //
    public function roles(){
        return $this->belongsToMany(
            'App\Models\Group\GroupRole','group_member_group_role','member_id','role_id'
        );
    }
}
