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
     * Show the form for editing the specified resource.
     *
     * @param  int  $group_id,$base_id
     * @return \Illuminate\Http\Response
     */
    public function edit($group_id,$base_id)
    {
        //
        $group=Group::find($group_id);
        return view('group.info_base.edit.'.$base_id)->with([
            'info'=>$info,
            'group'=>$info->group()->first(),
            'base'=>$info->base()->first()
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $group_id,$base_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$group_id,$base_id)
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
