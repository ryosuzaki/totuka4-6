<?php

namespace App\Http\Controllers\Group;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Group\Group;
use App\Models\Group\GroupInfoBase;
use App\Models\Group\GroupInfo;

use Illuminate\Support\Facades\Auth;
use Validator;

class GroupInfoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @param  int $group_id $base_id
     * @return \Illuminate\Http\Response
     */
    public function create($group_id,$base_id)
    {
        //
        return view('group.info.create')->with([
            'group'=>Group::find($group_id),
            'base'=>GroupInfoBase::find($base_id),
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  int $group_id,$base_id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$group_id,$base_id)
    {
        //validation
        $validator = Validator::make($request->all(),[
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        //info
        GroupInfo::create([
            'group_id'=>$group_id,
            'base_id'=>$base_id,
            'updated_by'=>Auth::id(),
        ]);
        Group::find($group_id)->infoBases()->attach($base_id);
        return redirect()->route('group.show',$group_id);
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
        $info=GroupInfo::find($id);
        return view('group.info.edit')->with(['info'=>$info,'group'=>$info->group()->first(),'base'=>$info->base()->first()]);
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
        //softdelete groupInfo
        $info=GroupInfo::find($id);
        $group=$info->group();
        $base=$info->base();
        $info->delete();
        //info
        GroupInfo::create([
            'group_id'=>$group->id,
            'base_id'=>$base->id,
            'updated_by'=>Auth::id(),
            'info'=>$request->toArray()['info'],
        ]);
        return redirect()->route('group.show',$group->id);
    }
}
