<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\GroupPost;
use App\Http\Controllers\GroupPostInvite;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\StudentsController;
use App\Models\Person;
use App\Models\Posts;
use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//  Route::middleware('dashboard')->get('/dashboard', function () {
    // $studentId = session('student');
    // $student = App\Models\Students::find($studentId);

    // return response()->json([
//         'message' => 'Welcome!',
//         'user' => $studentId,
//     ]);
// });


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/allfriends',[PostController::class,'allfriends']);
Route::post('/signup',[PersonController::class,'signup']);
Route::post('/createstudent',[StudentsController::class,'createstudent']);
Route::post('/getcurrentstudent',[StudentsController::class,'getcurrentstudent']);
Route::get('/allposts',[PostController::class,'allposts']);
Route::post('/createlogin',[StudentsController::class,'createlogin']);
Route::post('/createbio',[StudentsController::class,'createbio']);
Route::post('/editname',[StudentsController::class,'editname']);
Route::post('/allusers',[StudentsController::class,'allusers']);
Route::post('/follower',[FollowerController::class,'followers']);
Route::post('/allfollowers',[FollowerController::class,'allfollowers']);
Route::post('/allfollowing',[FollowerController::class,'allfollowing']);
Route::post('/post',[PostController::class,'createpost']);
Route::get('/allposts',[PostController::class,'allposts']);
Route::post('/allfollowing',[PostController::class,'allfollowing']);
Route::post('/comment',[CommentController::class,'comment']);
Route::post('/studentprofilepicture',[StudentsController::class,'studentprofilepicture']);
Route::post('/like',[LikesController::class,'like']);
Route::post('/unlike',[LikesController::class,'unlike']);
 Route::post('/dashboard', [StudentsController::class, 'dashboards']);
 Route::post('/verifyemail', [StudentsController::class, 'verifyemail']);
 Route::post('/passwordupdate',[StudentsController::class,'passwordupdate']);
 Route::post('/reply', [ReplyController::class, 'reply']);
  Route::post('/mypost', [PostController::class, 'mypost']);
  Route::post('/creategroup',[GroupController::class,'creategroup']);
  Route::post('/getgroup',[GroupController::class,'getgroup']);
  Route::post('/creategrouppost',[GroupPost::class,'creategrouppost']);
  Route::post('/getgrouppost',[GroupPost::class,'getgrouppost']);
  Route::post('/grouppostinvite',[GroupPostInvite::class,'grouppostinvite']);
  Route::post('/getinvite',[GroupPostInvite::class,'getinvite']);
  Route::post('/acceptinvite',[GroupPostInvite::class,'acceptinvite']);
  Route::post('/getallgroups',[GroupController::class,'getallgroups']);
  

