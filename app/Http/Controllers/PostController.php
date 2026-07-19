<?php

namespace App\Http\Controllers;

use App\Models\Followers;
use App\Models\Posts;
use App\Models\Students;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
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

    public function createpost(Request $req)
{
    $req->validate([
        'student_id' => 'required',
        'content' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096'
    ]);

    try {

        if (!$req->content && !$req->hasFile('image')) {
            return response()->json([
                'status' => false,
                'message' => 'Please enter content or select an image.'
            ], 422);
        }

        $createpost = new Posts();

        $createpost->student_id = $req->student_id;
        $createpost->content = $req->content;

        if ($req->hasFile('image')) {

            $uploaded = Cloudinary::upload(
                $req->file('image')->getRealPath(),
                [
                    'folder' => 'posts/images'
                ]
            );

            $createpost->post_img = $uploaded->getSecurePath();
        }

        $createpost->save();

        return response()->json([
            'status' => true,
            'message' => 'Post created successfully',
            'post' => $createpost
        ], 200);

    } catch (\Exception $e) {

        return response()->json([
            'status' => false,
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine()
        ], 500);
    }
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
// public function allfollowing(Request $req){
//     $resp=[];
//     $all=Followers::where('follower_id',$req->userid)->where('status','follow')->get();
//     foreach ($all as $id) {
//         $resp[]=$id->following_id;
//     }

//  $allposts=Posts::whereIn('student_id',$resp)->with(['student','likes','comments','comments.student','comments.replies','comments.replies.student','followers'])->get();
//     if($allposts->count()>0){

//         return json_encode([
//                'status'=>'200',
//                'post'=>$allposts
//            ]);
//     }
//     else{
//          return json_encode([
//             'status'=>'201',
//             'msg'=>'No posts found yet'
//         ]);
//     }

// }


public function allfriends(Request $req)
{
    $followerIds = Followers::where('following_id', $req->userid)
        ->pluck('follower_id');

    $followers = Students::whereIn('student_id', $followerIds)->get();

    return response()->json([
        'status' => true,
        'followers' => $followers
    ]);
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
