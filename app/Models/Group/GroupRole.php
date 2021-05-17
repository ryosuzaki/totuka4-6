<?php

namespace App\Models\Group;

use Illuminate\Database\Eloquent\Model;

class GroupRole extends Model
{
    //
    protected $guarded=[];
    //
    protected $casts = [
        'permissions'  => 'json',
    ];
    //
    protected $hidden = [
        'password',
    ];
    //
    public function group(){
        return $this->belongsTo('App\Models\Group\Group', 'group_id');
    }
    //
    public function members(){
        return $this->belongsToMany(
            'App\Models\Group\GroupMember','group_member_group_role','role_id','member_id'
        );
    }
}
