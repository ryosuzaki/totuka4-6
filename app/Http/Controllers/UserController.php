<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Validator;


class UserController extends Controller
{
    //
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user=User::find($id);
        return view('user.show')->with(['user'=>$user,'bases'=>$user->infoBases()->get(),'infos'=>$user->infos()->get()]);
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
        return view('user.edit')->with(['user'=>User::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validation
        $validator = Validator::make($request->all(),[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $user=User::find($id);
        $user->fill([
            'name'=>$request['name'],
            'email'=>$request['email'],
        ])->save();
        return redirect()->route('user.show',$id);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user=User::find($id);
        $user->infos()->delete();
        $user->delete();
        return redirect()->route('home');
    }

    /**
     * Attach user to group
     *
     * @param int $user_id,$group_id
     * @return \Illuminate\Http\Response
     */
    public function attachGroup($user_id,$group_id)
    {
        $user=User::find($user_id);
        $user->groups()->attach($group_id);
        return redirect()->route('user.show',$user_id);
    }

    /**
     * Detach user to group
     *
     * @param int $user_id,$group_id
     * @return \Illuminate\Http\Response
     */
    public function detachGroup($user_id,$group_id)
    {
        $user=User::find($user_id);
        $user->groups()->detach($group_id);
        return redirect()->route('user.show',$user_id);
    }

    /**
     * Attach question to user
     *
     * @param int $user_id,$question_id
     * @return \Illuminate\Http\Response
     */
    public function attachQuestion($user_id,$question_id)
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
    public function detachQuestion($user_id,$question_id)
    {
        $user=User::find($user_id);
        $user->questions()->detach($question_id);
        return redirect()->route('user.question.index',$user_id);
    }
}
