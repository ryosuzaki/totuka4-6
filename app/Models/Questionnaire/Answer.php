<?php

namespace App\Models\Questionnaire;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    //
    protected $guarded = [];
    //
    protected $casts = [
        'answers'  => 'json',
    ];
    //
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
    public function question(){
        return $this->belongsTo('App\Question','question_id');
    }
}
