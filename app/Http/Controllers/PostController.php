<?php

namespace App\Http\Controllers;

use App\Models\Followers;
use App\Models\Posts;
use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
//     public function createpost(Request $req) {
//     if ($req->hasFile('image')) {
//         return json_encode($req->file('image')->getClientOriginalName());
//     } else {
//         return json_encode("No image uploaded");
//     }
// }

    public function createpost(Request $req){
        if($req->hasFile('image') && $req->content){

        $newname=time().$req->file('image')->getClientOriginalName();
        $move=$req->file('image')->move(public_path('postimages'),$newname);
        if($move){
        $createpost=new Posts;
        $createpost->student_id=$req->student_id;
        $createpost->content=$req->content;
        $createpost->post_img=$newname;

        $save=$createpost->save();
        if($save){
         return json_encode([
            'status'=>200,
            'msg'=>'Post created successfully'
        ]);   
        }
        else{
            return json_encode([
            'status'=>202,
            'msg'=>'Something went wrong, try again!'
        ]);
        }
    
        }
        else{
             return json_encode([
            'status'=>204,
            'msg'=>'Something went wrong, try again!'
        ]);
        }
        }
        else if($req->content && !$req->file('image')){
            $createpost=new Posts;
        $createpost->student_id=$req->student_id;
        $createpost->content=$req->content;
        $save=$createpost->save();
        if($save){
         return json_encode([
            'status'=>206,
            'msg'=>'Post created successfully'
        ]);   
        }
        else{
            return json_encode([
            'status'=>208,
            'msg'=>'Something went wrong, try again!'
        ]);
        }

            
        }
        // 
    }

public function mypost(Request $req){
$allposts=Posts::where('student_id',$req->student_id)->with(['student','likes','comments','comments.student','comments.replies','comments.replies.student'])->get();
    if($allposts->count()>0){
        return json_encode([
               'status'=>200,
               'post'=>$allposts
           ]);
    }
    else{
         return json_encode([
            'status'=>201,
            'msg'=>'No posts found yet, create posts'
        ]);
    }
  
}

public function allposts(){
    $allpost=Posts::with(['student','likes','comments','comments.student','comments.replies','comments.replies.student','followers'])->get();
// $post=Posts::all();
return json_encode([
               'status'=>'200',
               'post'=>$allpost
           ]);
}
public function allfollowing(Request $req){
    $resp=[];
    $all=Followers::where('follower_id',$req->userid)->where('status','follow')->get();
    foreach ($all as $id) {
        $resp[]=$id->following_id;
    }
   
 $allposts=Posts::whereIn('student_id',$resp)->with(['student','likes','comments','comments.student','comments.replies','comments.replies.student','followers'])->get();
    if($allposts->count()>0){

        return json_encode([
               'status'=>'200',
               'post'=>$allposts
           ]);
    }
    else{
         return json_encode([
            'status'=>'201',
            'msg'=>'No posts found yet'
        ]);
    }
   
}


public function allfriends(Request $req){
    $resp=[];
    $all=Followers::where('follower_id',$req->userid)->where('status','follow')->get();
    foreach ($all as $id) {
        $resp[]=$id->following_id;
        
    }
   
    
 $allfriends=Students::whereIn('student_id',$resp)->get();
    if($allfriends->count()>0){
    
        return json_encode([
               'status'=>'200',
               'friends'=>$allfriends
           ]);
    }
    else{
         return json_encode([
            'status'=>'201',
            'msg'=>'No friends found yet'
        ]);
    }
}



//     public function createpost(){
//         $allpost=DB::table('posts')->get();
//         // return $allpost;
//         return view('posts.postpage',[
//             'allpost'=>$allpost
//         ]);
//     }
//     public function create(Request $req){
//         $post=DB::table('posts')->insert([
//          'name'=>$req->name,
//          'age'=>$req->age
//         ]);
//         if ($post){

//             return redirect('/post');
//         }
//         else{
// return '123';
//         }
//     }
//     public function uniquepost($id){
//         $post=DB::table('posts')->where('post_id',$id)->first();
//         return view('posts.uniquepost',[
//             'allpost'=>$post
//         ]);
//     }
}
