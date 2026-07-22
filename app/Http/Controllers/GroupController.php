<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
 public function creategroup(Request $request){
   try {
    $group=new Group();
    $group->student_id = $request->student_id;
    $group->uniquenumber = $request->uniquenumber;
    $group->name = $request->groupname;
    $group->privacy = $request->privacy;

    return response()->json([
        'status' => true,
        'message' => 'Group created successfully',
        'group' => $group,
    ],200);

    } catch (\Exception $e) {
       return response()->json(
        [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
        ], 500);
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
