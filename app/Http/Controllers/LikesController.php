<?php

namespace App\Http\Controllers;

use App\Models\Likes;
use Illuminate\Http\Request;

class LikesController extends Controller
{
    public function like(Request $req){
      $like=Likes::where('student_id',$req->studentid)->where('post_id',$req->postid)->first();
      if($like){
        $like->status=$like->status==1?0:1;
        $like->save();
    //  $like->delete();

        return json_encode('Already liked');
  }
  else{
     $like=new Likes;
  $like->student_id=$req->studentid;
  $like->post_id=$req->postid;
  $like->status=1;
  $save=$like->save();
  if($save){
return json_encode([
            'status'=>'200',
            'check'=>$like->status==1?'Liked':'Unliked',
            'msg'=>'Liked'
        ]);
      }
      else{
        return json_encode('like now');

      }
  }
  

    }

//     public function unlike(Request $req){
//   $like=Likes::where('student_id',$req->studentid)->where('post_id',$req->postid)->update([
//      'status'=>0
//   ]);
//   if($like){
// return json_encode([
//             'status'=>'200',
//             'msg'=>'Unlike'
//         ]);
//   }
//   else{
//         return json_encode('failed to unlike');
//   }
  

//     }
}
