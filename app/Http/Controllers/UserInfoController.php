<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\User;
use App\UserInfoBase;
use App\UserInfo;

class UserInfoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @param  int $user_id $base_id
     * @return \Illuminate\Http\Response
     */
    public function create($user_id,$base_id)
    {
        //
        return view('user.info.create')->with([
            'user'=>User::find($user_id),
            'base'=>UserInfoBase::find($base_id),
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  int $user_id,$base_id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$user_id,$base_id)
    {
        //validation
        $validator = Validator::make($request->all(),[
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        //info
        UserInfo::create([
            'user_id'=>$user_id,
            'base_id'=>$base_id,
        ]);
        User::find($user_id)->infoBases()->attach($base_id);
        return redirect()->route('user.show',$user_id);
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
        $info=UserInfo::find($id);
        return view('user.info.edit')->with(['info'=>$info,'user'=>$info->user()->first(),'base'=>$info->base()->first()]);
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
            
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        //
        $info=UserInfo::find($id);
        $info->fill([
            'info'=>$request->toArray()['info'],
        ])->save();
        return redirect()->route('user.show',$info->user_id);
    }
}
