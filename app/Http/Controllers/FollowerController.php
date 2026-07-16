<?php

namespace App\Http\Controllers;

use App\Models\Followers;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function followers(Request $req){
//       if($req->followingstatus==='Unfollow'){
//         $follower=Followers::where('follower_id',$req->follower_id)->where('following_id',$req->following_id)->update(
//           ['status'=>'Follow']
//         );
//         if($follower){
//             return json_encode([
//             'status'=>'204',
//             'msg'=>'Follow'
//            ]); 
//         }
//       }
//       else if($req->follow_status==='follow'){
// $followers=new Followers;
//       $followers->follower_id=$req->follower_id;
//       $followers->follower_name=$req->follower_name;
//       $followers->following_id=$req->following_id;
//       $followers->following_name=$req->following_name;
//       $followers->status='unfollow';
//      $save= $followers->save();
//      if($save){
//             return json_encode([
//             'status'=>'205',
//             'msg'=>'Unfollow'
//            ]); 
//         }
//       }
        $student=Followers::where('follower_id',$req->follower_id)->where('following_id',$req->following_id)->where('status','unfollow')->first();

        $studentcheck=Followers::where('follower_id',$req->follower_id)->where('following_id',$req->following_id)->where('status','follow')->first();
        if($student){
          $update=Followers::where('follower_id',$req->follower_id)->where('following_id',$req->following_id)->update(
            ['status'=>'follow']
          );
           if($update){
            return json_encode([
        // 'status'=>'204',
         'msg'=>'now following'
           ]); 
           }
        }
        else if($studentcheck){
$update=Followers::where('follower_id',$req->follower_id)->where('following_id',$req->following_id)->update(
            ['status'=>'unfollow']
          ); 
           if($update){
            return json_encode([
    //         'status'=>'204',
         'msg'=>'unfollowing'
           ]); 
           }
        }
        else{
         $followers=new Followers;
      $followers->follower_id=$req->follower_id;
      $followers->follower_name=$req->follower_name;
      $followers->following_id=$req->following_id;
      $followers->following_name=$req->following_name;
      $followers->status='follow';
     $save= $followers->save(); 
     if($save){
      return json_encode([
    //         'status'=>'204',
         'msg'=>'newly following'
           ]); 
     }
        }
        
    //     if($student){
    //        return json_encode([
    //         'status'=>'204',
    //         'msg'=>'not Following'
    //        ]); 
    //     }
    //     else{
    //     $followers=new Followers;
    //   $followers->follower_id=$req->follower_id;
    //   $followers->follower_name=$req->follower_name;
    //   $followers->following_id=$req->following_id;
    //   $followers->status=$req->followingstatus==1?0:1;
    //  $save= $followers->save();
    //   if ($save){
    //     //  $like->status=$like->status==1?0:1;
    //     //  'check'=>$like->status==1?'Liked':'Unliked';
    //     $follower=Followers::where('follower_id',$req->follower_id)->where('following_id',$req->following_id)->update(
    //       ['status'=>1]
    //     );
    //     if($follower){

    //       return json_encode([
    //           'status'=>'205',
    //           'msg'=>'updated'
    //       ]);
    //     }
    //     else{
    //       return json_encode([
    //           'status'=>'204',
    //           'msg'=>'Following'
    //       ]);
    //     }

    //   }
    //   else{
    //     return json_encode([
    //         'status'=>'201',
    //         'msg'=>'Something went wrong'
    //     ]);
    //   }
    //     }
      

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
