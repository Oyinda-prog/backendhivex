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

    public function allfollowers(Request $req)
{
    $followers = Followers::where('following_id', $req->student_id)->get();

    return response()->json([
        'status' => true,
        'followers' => $followers
    ]);
}

//     public function allfollowing(Request $req)
// {
//     $following = Followers::where('follower_id', $req->student_id)->get();

//     return response()->json([
//         'status' => true,
//         'following' => $following
//     ]);
// }

public function allfollowing(Request $req)
{
    return response()->json([
        'status' => true,
        'message' => 'allfollowing reached'
    ]);
}

}
