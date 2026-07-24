<?php
namespace App\Http\Controllers;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use App\Models\Followers;
use App\Models\keepnote;
use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

// use function Ramsey\Uuid\v3;

class StudentsController extends Controller
{
public function allstudentsnotes(){

    $note=keepnote::with('student')->get();

    return view('students.allstudents',[
        'students'=>$note
    ]);

}

    public function signup(){

    return view('students.signup');

}


public function createbio(Request $req){
try {
    $update = Students::where('student_id', $req->student_id)->update([
        "bio" => $req->bio
    ]);

    if ($update){
        $student = Students::findOrfail($req->student_id);
       return response()->json(
           [
             'status' => true,
             'message' => "Bio updated successfully",
             'student' =>$student
           ], 200
        );
    }

     return response()->json(
           [
             'status' => false,
             'message' => "Bio update failed"
           ], 400
        );


} catch (\Exception $e) {
        return response()->json([
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
        ], 500);
}

}

public function editname(Request $req){
try {
    $update = Students::where('student_id', $req->student_id)->update([
        "fullname" => $req->fullname
    ]);

    if ($update){
        $student = Students::findOrfail($req->student_id);
       return response()->json(
           [
             'status' => true,
             'message' => "Full Name updated successfully",
             'student' =>$student
           ], 200
        );
    }

     return response()->json(
           [
             'status' => false,
             'message' => "Full Name update failed"
           ], 400
        );


} catch (\Exception $e) {
        return response()->json([
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
        ], 500);
}

}
public function createstudent(Request $req){
     $validation=Validator::make($req->all(),[
        'fullname'=>'required',
        'email'=>'required|email',
        'password'=>'required|min:3',
        'phonenumber'=>'required|numeric'
     ]);

  if($validation->fails()){
    //   $status=  [
    //       'status'=>'405',
    //       'msg'=>'Validation error'
    //     ];
        return json_encode([
          'status'=>200,
          'msg'=>$validation->errors()->first(),

        ]);
    // return view('students.signup')->with('errors',$validation->errors());
  }
  else{
    $student=Students::where('email',$req->email)->first();
    if($student){
        return json_encode([
            'status'=>'403',
            'msg'=>'User exists'
        ]);
        // return json_encode($req->email);
        // return view('students.signup')->with('error','Email already exists');
    }
    else{
        $student=new Students;
        $student->fullname=$req->fullname;
        $student->password=Hash::make($req->password);
        $student->email=$req->email;
        $student->phonenumber=$req->phonenumber;
        $store=$student->save();
       if($store){
        return json_encode([
            'status'=>'201',
            'msg'=>'Created successfully'
        ]);
        // return redirect('/login');
       }
    }

  }

}


public function createlogin(Request $req){
    $validation=Validator::make($req->all(),[
        'email'=>'required|email',
        'password'=>'required',
     ]);

    if($validation->fails()){
        return json_encode([
            'status'=>204,
            'msg'=>$validation->errors()->first()
        ]);
        // return view('students.login')->with('errors',$validation->errors());
    }
    else{
       $student=Students::where('email',$req->email)->first();

       if($student && Hash::check($req->password,$student->password)){
          return json_encode([
            'status'=>true,
            'msg'=>'User found',
            'student'=>$student

        ]);
       }
       else{
        return json_encode([
            'status'=>208,
            'msg'=>'Invalid email or password'
        ]);
        // return view('students.login')->with('msg','Invalid email or password');
       }
    }
}


public function allusers(Request $req)
{
    $currentUserId = $req->student_id;

    // Get every student except the logged-in student
    $otherStudents = Students::where('student_id', '!=', $currentUserId)->get();

    // Get everyone the current user is following
    $follows = Followers::where('follower_id', $currentUserId)->get();

    $followingIds = [];

    foreach ($follows as $follow) {
        $followingIds[$follow->following_id] = true;
    }

    // Add is_following to each student
    $students = $otherStudents->map(function ($student) use ($followingIds) {

        $student->is_following = isset($followingIds[$student->student_id]);

        return $student;
    });

    return response()->json([
        'status' => true,
        'students' => $students
    ]);
}


public function allfriends(Request $req)
{
    $currentUserId = $req->userid;

    $followers = Followers::where('following_id', $currentUserId)->with(['student'])->get();

    return response()->json([
        'status' => '200',
        'friends' => $followers
    ]);
}


public function verifyemail(Request $req){
    $email=Students::where('email',$req->email)->first();
    if($email){
     $update=Students::where('email',$req->email)->update([
        'emailverify'=>$req->token
     ]);
        if($update){
        $student=Students::where('email',$req->email)->first();
return response()->json([
            'status' => '200',
            'msg'=>'User found',
            'token'=>$student->emailverify

        ]);
        }
        else{
return response()->json([
            'status' => '504',
            'msg'=>'Try again!'
            // 'friends' => $followers
        ]);
        }
    }
    else{
       return response()->json([
            'status' => '501',
            'msg'=>'User does not exist. Please enter a valid email'
            // 'friends' => $followers
        ]);
    }
}
public function getcurrentstudent(int $id)
{
    $student=Students::find($id);
    if(!$student){
        return response()->json([
            'status' => false,
            'message'=>'Student not found'

        ], 404);
    }

    return response()->json([
        'status' => true,
        'student'=>$student

    ], 200);

}
public function passwordupdate(Request $req){
      $token=Students::where('emailverify',$req->token)->first();
      if($token){
        $token->password=Hash::make($req->password);
       $save=  $token->save();
       if($save){
        return response()->json([
            'status' => 200,
            'msg'=>'Password updated successfully'
        ]);
       }
       else{
        return response()->json([
            'status' => 501,
            'msg'=>'Something went wrong, try again!'
        ]);
       }
      }
      else{
 return response()->json([
            'status' => '504',
            'msg'=>'User does not exist. Please enter a valid email'

        ]);
      }

}

// public function studentprofilepicture(Request $req){
//     if($req->hasFile('image') && $req->student_id){

//         $newname=time().$req->file('image')->getClientOriginalName();
//         $move=$req->file('image')->move(public_path('profilepictures'),$newname);
//         if($move){
//         $profilepicture=Students::where('student_id',$req->student_id)->update([
//             'profilepicture'=>$newname
//         ]);

//         if($profilepicture){
//          return json_encode([
//             'status'=>'200',
//             'msg'=>'Profile picture uploaded successfully'
//         ]);
//         }
//         else{
//             return json_encode([
//             'status'=>'201',
//             'msg'=>'Something went wrong, try again!'
//         ]);
//         }

//         }
//         else{
//             return json_encode('failed to move');
//         }
//         }
// return json_encode($req->file('image'));
// }

public function studentprofilepicture(Request $request)
{
    $request->validate([
        'student_id' => 'required|exists:students_table,student_id',
        'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048'
    ]);

    try {

        $student = Students::findOrFail($request->student_id);

        //Delete previous image


        if (!empty($student->cloudinary_public_id)) {

            Cloudinary::destroy(
                $student->cloudinary_public_id
            );

        }

         // upload new image
        $uploaded = Cloudinary::upload(
            $request->file('image')->getRealPath(),
            [
                'folder' => 'students/profilepictures',

                'transformation' => [
                    'width' => 400,
                    'height' => 400,
                    'crop' => 'fill',
                    'gravity' => 'auto',
                    'quality' => 'auto'
                ]
            ]
        );

         // save to database
        $student->profilepicture = $uploaded->getSecurePath();

        $student->cloudinary_public_id = $uploaded->getPublicId();

        $student->save();

        return response()->json([
            'status' => true,
            'message' => 'Profile picture uploaded successfully.',
            'image_url' => $student->profilepicture
        ], 200);

    } catch (\Exception $e) {
         return response()->json([
        'message' => $e->getMessage(),
        'file' => $e->getFile(),
        'line' => $e->getLine(),
    ], 500);

        // return response()->json([
        //     'status' => false,
        //     'message' => $e->getMessage()
        // ], 500);

    }
}

public function dashboard(){
    $student = session('student');
    if (!$student) {
        return view('students.login')->with('loginmsg','login first');
    }
    return view('students.dashboard')->with('students', $student);
}

public function deletestudent(Request $req){
    $delete=Students::where('student_id',$req->student_id)->first()->delete();
    if($delete){
        return redirect('/login');
    }
    else{
        return view('students.dashboard');
    }
// return $req->student_id;
}
public function editstudent($id){
    $student=Students::where('student_id',$id)->first();
    if($student){
        return view('students.studentedit')->with('student',$student);
    }
    else{
        // $msg='no student found';
        return view('students.studentedit');
    }
    //  return $student;
}
public function updatestudent(Request $req,$id){
    return $req;
}
public function forgotpass(){
    return view('students.forgot');
}

public function forgot(Request $request){
    $student=Students::where('email',$request->email)->first();
    $msg='User not found';
    if($student){
session(['id'=>$student->student_id]);
   return redirect('/forgotpassword');
//
    }
    else{
        return view('students.forgot')->with('msg',$msg);
    }

}
public function forgotpassword(){
    $id=session('id');

return view('students.verifypassword',[
    'studentid'=>$id,

]);
}
public function verifypassword(Request $request){
    if($request->passwordone!==$request->passwordtwo){
        $errormsg='Please enter the same password';
        return redirect()->route('verifypassword')->with('success',$errormsg);
    }
    else{
        $update=Students::where('student_id',$request->id)->update(
            ['password'=>Hash::make($request->passwordtwo)]
        );
        if($update){
   return 'updated';
        }
        else{
           return 'failed to update';
        }


   return 'correct';
    }

}
public function allstudents(){
    // $students=Students::with('keepnotes')->get();
    $notes=keepnote::with('student')->get();
    return $notes;
}
public function allnotes(int $id){
    $student=Students::where('student_id',$id)->first();
    return view('students.allnotes',[
        'allnotes'=>$student->keepnotes
    ]);
}
public function notestudent(int $id){
    $note=keepnote::with('student')->where('student_id',$id)->get();
    return view('students.notestudent',[
        'notestudent'=>$note
    ]);
}
public function dashboards(Request $request){
 $studentId =$request->student_id;;
//

    return response()->json([
        'message' => 'Welcome!',
        'user' => $studentId,
    ]);
}

public function getsummary(int $id){
try {
    $summary = Students::with(['posts', 'followers.follower',
    'following.following'])->where('student_id', $id)-> first();
    if ($summary){
        return response()->json( $summary,200
        );
    }

    return response()->json(
            [
               'status' => false,
               'message' => 'Summary not found',

            ],
            404
        );
} catch (\Exception $e) {
    return response()->json(
        [
            'message' => $e->getMessage(),
            'line' => $e->getLine(),
            'file' => $e->getFile()
        ], 500
    );
}
}
}

