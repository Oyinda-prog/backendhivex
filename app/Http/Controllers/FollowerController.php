<?php

namespace App\Http\Controllers;

use App\Models\Followers;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function followers(Request $request)
{
    $follow = Followers::where('follower_id', $request->follower_id)
        ->where('following_id', $request->following_id)
        ->first();

    if ($follow) {

        $follow->delete();

        return response()->json([
            'status' => true,
            'message' => 'Unfollowed'
        ]);

    } else {

        Followers::create([
            'follower_id' => $request->follower_id,
            'following_id' => $request->following_id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Following'
        ]);
    }
}

    public function allfollowers(Request $req){
      $follower=Followers::where('following_id',$req->student_id)->where('status','follow')->get();
      if($follower->count()>0){
return json_encode([
               'status'=>200,
               'follower'=>$follower
           ]);
      }
      else{
        return json_encode([
               'status'=>201,
               'msg'=>0
           ]);
      }
    }

    public function allfollowing(Request $req){
      $following=Followers::where('follower_id',$req->student_id)->where('status','follow')->get();
      if($following->count()>0){
return json_encode([
               'status'=>200,
               'following'=>$following
           ]);
      }
      else{
        return json_encode([
               'status'=>201,
               'msg'=>0
           ]);
      }
    }
}
