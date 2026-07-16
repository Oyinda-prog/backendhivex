<?php

namespace App\Http\Controllers;
use App\Models\GroupPost as ModelsGroupPost;
use App\Models\Posts;
use Illuminate\Http\Request;

class GroupPost extends Controller
{
    public function creategrouppost(Request $req){
        if($req->hasFile('image') && $req->content){

        $newname=time().$req->file('image')->getClientOriginalName();
        $move=$req->file('image')->move(public_path('grouppostimages'),$newname);
        if($move){
        $createpost=new ModelsGroupPost();
        $createpost->student_id=$req->poster_id;
        $createpost->content=$req->content;
        $createpost->uniquenumber=$req->uniquenumber;
        $createpost->role=$req->role;
        $createpost->group_id=$req->group_id;
        $createpost->image=$newname;

        $save=$createpost->save();
        if($save){
         return json_encode([
            'status'=>'200',
            'msg'=>'Post created successfully'
        ]);   
        }
        else{
            return json_encode([
            'status'=>'201',
            'msg'=>'Something went wrong, try again!'
        ]);
        }
    
        }
        else{
            return json_encode('failed to move');
        }
        }
        else if($req->content && !$req->file('image')){
        $createpost=new ModelsGroupPost();
        $createpost->student_id=$req->poster_id;
        $createpost->content=$req->content;
        $createpost->uniquenumber=$req->uniquenumber;
        $createpost->role=$req->role;
        $createpost->group_id=$req->group_id;
        $save=$createpost->save();
        if($save){
         return json_encode([
            'status'=>'200',
            'msg'=>'Post created successfully'
        ]);   
        }
        else{
            return json_encode([
            'status'=>'201',
            'msg'=>'Something went wrong, try again!'
        ]);
        }

            
        }
    
    }
   
public function getgrouppost(Request $req){
    $groupposts=ModelsGroupPost::where('uniquenumber',$req->uniquenumber)->where('student_id',$req->student_id)->get();
if($groupposts){
 return json_encode([
            'status'=>'201',
            'msg'=>'Post found!',
            'posts'=>$groupposts
        ]);
}
else{
 return json_encode([
            'status'=>'501',
            'msg'=>'No posts made yet!',
            
        ]);
}
}
}
