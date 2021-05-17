<?php

namespace App\Http\Controllers\Group;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Group\Group;
use App\Models\Group\GroupRole;
use App\Models\Group\GroupMember;
use App\Models\Group\GroupInfo;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;


class GroupController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('group.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate
        $validator = Validator::make($request->all(),[
            'name'=>'required|max:255',
            'password'=>'required|alpha_num|min:4|max:255|confirmed'//password_confirmation
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        //create relate models
        $group=Group::create([
            'name'=>$request->name,
        ]);
        $admin=GroupRole::create([
            'group_id'=>$group->id,
            'role_id'=>0,
            'name'=>'admin',
            'password'=>Hash::make($request->password),
        ]);

        $member=GroupMember::create([
            'user_id'=>Auth::id(),
            'group_id'=>$group->id,
            'role_id'=>0,
        ]);
        $info=GroupInfo::create([
            'group_id'=>$group->id,
            'base_id'=>1,
            'updated_by'=>Auth::id(),
        ]);
        $group->infoBases()->attach(1);
        return redirect()->route('group.show',$group->id);
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
        $group=Group::find($id);
        return view('group.show')->with(['group'=>$group,'bases'=>$group->infoBases()->get(),'infos'=>$group->infos()->get()]);
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
        return view('group.edit')->with(['group'=>Group::find($id)]);
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
        $validator = Validator::make($request->all(),[
            'name'=>'required|max:255',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $group=Group::find($id)->fill([
            'name'=>$request['name'],
        ])->save();
        return redirect()->route('group.show',  $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete all relate models
        $group=Group::find($id);
        $group->infos()->delete();
        $group->info_bases()->delete();
        $group->members()->delete();
        $group->roles()->delete();
        $group->delete();
        return redirect()->route('group.home');
    }

    /**
     * Attach user to group
     *
     * @param int $group_id,$user_id
     * @return \Illuminate\Http\Response
     */
    public function attachUser($group_id,$user_id)
    {
        $group=Group::find($group_id);
        $group->users()->attach($user_id);
        return redirect()->route('user.show',$user_id);
    }

    /**
     * Detach user to group
     *
     * @param int $group_id,$user_id
     * @return \Illuminate\Http\Response
     */
    public function detachUser($group_id,$user_id)
    {
        $group=Group::find($group_id);
        $group->users()->detach($user_id);
        return redirect()->route('user.show',$user_id);
    }
}
