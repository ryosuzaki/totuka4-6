<?php

namespace App\Http\Controllers\Questionnaire;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Questionnaire\Question;
use App\User;

class UserQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param int $user_id
     * @return \Illuminate\Http\Response
     */
    public function index($user_id)
    {
        //
        $user=User::find($user_id);
        return view('questionnaire.user_question.index')->with(['user'=>$user,'questions'=>$user->questions()->get()]);
    }

    /**
     * Attach question to user
     *
     * @param int $user_id,$question_id
     * @return \Illuminate\Http\Response
     */
    public function attachGroup($user_id,$question_id)
    {
        $user=User::find($user_id);
        $user->questions()->attach($question_id);
        return redirect()->route('user.question.index',$user_id);
    }

    /**
     * Detach question to user
     *
     * @param int $user_id,$question_id
     * @return \Illuminate\Http\Response
     */
    public function detachGroup($user_id,$question_id)
    {
        $user=User::find($user_id);
        $user->questions()->detach($question_id);
        return redirect()->route('user.question.index',$user_id);
    }

}
