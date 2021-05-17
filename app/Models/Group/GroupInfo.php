<?php

namespace App\Models\Group;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GroupInfo extends Model
{
    use SoftDeletes;
    //
    protected $guarded = [];
    //
    protected $casts = [
        'info'  => 'json',
    ];
    /**
     * 日付へキャストする属性
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    //
    public function base(){
        return $this->belongsTo('App\Models\Group\GroupInfoBase', 'base_id');
    }
    //
    public function group(){
        return $this->belongsTo('App\Models\Group\Group', 'group_id');
    }
    
}
