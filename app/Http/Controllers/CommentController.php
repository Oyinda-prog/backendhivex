<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function comment(Request $req){
      $comment=new Comments;
      $comment->comment=$req->comment;
       $comment->student_id=$req->studentid;
        $comment->post_id=$req->postid;
         $save=$comment->save();
         if($save){
return json_encode([
               'status'=>'200',
               'msg'=>'Comment made'
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
