<?php

namespace App\Http\Controllers;

use App\Models\GroupPostInvite as ModelsGroupPostInvite;
use Illuminate\Http\Request;

class GroupPostInvite extends Controller
{
  public function grouppostinvite(Request $req){
    $check=ModelsGroupPostInvite::where('inviter_id',$req->inviter_id)->where('invitee_id',$req->invitee_id)->where('uniquenumber',$req->uniquenumber)->first();
    if($check){
        return json_encode([
            'status'=>'502',
            'msg'=>'Invite already sent!'
        ]);
    }
    else{
        $invite=new ModelsGroupPostInvite();
    $invite->inviter_id=$req->inviter_id;
    $invite->invitee_id=$req->invitee_id;
    $invite->uniquenumber=$req->uniquenumber;
    $invite->status='Sent';
    $save=$invite->save();
    if($save){
return json_encode([
            'status'=>'200',
            'msg'=>'Invite sent'
        ]);
    }
    else{
        return json_encode([
            'status'=>'501',
            'msg'=>'Something went wrong. Try again!'
        ]);
    }
    }
// return response()->json('work');
  }
  public function getinvite(Request $req){
    $allinvites=ModelsGroupPostInvite::where('invitee_id',$req->student_id)->with('grouppost')->with('group')->get();
 if($allinvites->count()>0){
return json_encode([
            'status'=>'200',
            'msg'=>'Invitations found!',
            'allinvites'=>$allinvites
        ]);
 }
 else{
    return json_encode([
            'status'=>'501',
            'msg'=>'No invitation yet!',
            
        ]);
 }
  }
  public function acceptinvite(Request $req){
       $invite=ModelsGroupPostInvite::where('grouppostinvites_id',$req->id)->update([
        'status'=>'Accepted'
       ]);
       if($invite){
 return json_encode([
            'status'=>'200',
            'msg'=>'Invite Accepted!',
            
        ]);
       }
       else{
 return json_encode([
            'status'=>'501',
            'msg'=>'Something went wrong. Try again!',
            
        ]);
       }
  }
}
