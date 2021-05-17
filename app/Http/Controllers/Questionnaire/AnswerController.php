<?php

namespace App\Http\Controllers\Questionnaire;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Questionnaire\Answer;
use App\Models\Questionnaire\Question;
use app\User;

class AnswerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_id,$question_id)
    {
        //
        $user=User::find($user_id);
        return view('questionnaire.answer.index')->with([
            'user'=>$user,
            'question'=>Question::find($question_id),
            'answers'=>$user->answers()->where('question_id',$question_id)->get(),
            ]);
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @param  int $user_id $question_id
     * @return \Illuminate\Http\Response
     */
    public function create($user_id,$question_id)
    {
        //
        return view('questionnaire.answer.create')->with([
            'user'=>User::find($user_id),
            'question'=>Question::find($question_id),
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  int $user_id,$question_id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$user_id,$question_id)
    {
        //validation
        $validator = Validator::make($request->all(),[
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        //answer
        Answer::create([
            'user_id'=>$user_id,
            'question_id'=>$question_id,
            'answers'=>$request->toArray()['info'],
        ]);
        User::find($user_id)->questions()->attach($question_id);
        return redirect()->route('user.question.answer.index',[$user_id,$question_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return view('questionnaire.answer.show')->with(['answer'=>Answer::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $answer=Answer::find($id);
        return view('questionnaire.answer.edit')->with(['answer'=>$answer,'user'=>$answer->user()->first(),'question'=>$answer->question()->first()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //validation
        $validator = Validator::make($request->all(),[

        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        //answer
        $answer=Answer::find($id);
        $answer->fill([
            'answers'=>$request->toArray()['info'],
        ])->save();
        return redirect()->route('user.show',$user->id);
    }
}
