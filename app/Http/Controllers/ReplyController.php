<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\Reply;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
public function reply(Request $req){
// return json_encode($req->all());
$reply=new Reply;
      $reply->comment_id=$req->commentid;
       $reply->student_id=$req->studentid;
        $reply->post_id=$req->postid;
        $reply->reply=$req->reply;
         $save=$reply->save();
         if($save){
return json_encode([
               'status'=>'200',
               'msg'=>'Reply made'
]);
         }
         else{
            return json_encode([
               'status'=>'201',
               'post'=>'Something went wrong. Try again!'
           ]);
         }
    }
}

