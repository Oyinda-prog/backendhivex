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
   $save = $group->save();
    if ($save) {
        return response()->json([
            'status' => true,
            'message' => 'Group created successfully',
            'group' => $group,
        ], 200);
    }

     return response()->json([
            'status' => false,
            'message' => 'Unable to create group',
        ], 400);


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

  public function getallgroups(int $id){
    try {
        $allgroups = Group::where('student_id', $id)->get();
        if ($allgroups->isEmpty()){
            return response()->json(
               [
                  'status'=> false,
                  'message'=> 'No groups created yet!'
               ], 200
            );
        }

        return response()->json(
            [
                'status'=> true,
                'message'=> 'Group found!',
                'allgroups' => $allgroups
            ], 200
        );
    } catch (\Exception $e) {
        return response()->json(
            [
                'file'=>$e->getFile(),
                'line'=>$e->getLine(),
                'message'=>$e->getMessage(),
            ], 500
        );
    }

  }
}
