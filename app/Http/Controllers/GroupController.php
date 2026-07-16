<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
 public function creategroup(Request $request){
    $store=new Group();
    $store->student_id = $request->student_id;
    $store->uniquenumber = $request->uniquenumber;
    $store->name = $request->groupname;
    $store->privacy = $request->privacy;
    $store->profilepicture=$request->profilepicture;
    $store->fullname=$request->fullname;
  $check= $store->save();
  if($check){
        return response()->json([
            'message' => 'Group created successfully',
            'group' => $store,
            'status' => 201
        ]);

  }
  else{
        return response()->json([
            'message' => 'Group creation failed',
            'status' => 500
        ]);
  }
     
 }
 public function getgroup(Request $req){
   $group=Group::where('student_id',$req->student_id)->where('uniquenumber',$req->uniquenumber)->first();
   if($group){
return response()->json([
            'message' => 'Group found',
            'status' => 200,
            'group'=>$group
        ]);
   }
   else{
     response()->json(
        ['status'=>500,
        'message'=>'Group does not exist']
     );
   }
 }
  public function getallgroups(Request $req){
    $allgroups=Group::where('student_id',$req->student_id)->get();
 if($allgroups->count()>0){
return json_encode([
            'status'=>200,
            'msg'=>'Invitations found!',
            'allgroups'=>$allgroups
        ]); 
 }
 else{
    return json_encode([
            'status'=>201,
            'msg'=>'No invitation yet!',
            
        ]);
 }
  }
}
