<?php

namespace App\Models\Questionnaire;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    protected $guarded = [];
    //
    protected $casts = [
        'questions'  => 'json',
    ];
    //
    public function answers(){
        return $this->hasMany('App\Answer','question_id');
    }
    //
    public function users(){
        return $this->belongsToMany(
            'App\User','user_question','question_id','user_id'
        );
    }
}
