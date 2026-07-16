<?php
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

// Route::post('/login', function (Request $request) {
//     $credentials = $request->only('email', 'password');

//     if (Auth::attempt($credentials)) {
//         $request->session()->regenerate();

//         return response()->json(['message' => 'Logged in']);
//     }

//     return response()->json(['message' => 'Invalid credentials'], 401);
// });

// namespace App\Http\Middleware;

// use Closure;
// use Illuminate\Http\Request;

// class StudentAuth
// {
//     public function handle(Request $request, Closure $next)
//     {
//         if (!$request->session()->has('student')) {
//             return response()->json(['message' => 'Unauthenticated.'], 401);
//         }

//         return $next($request);
//     }
// }

// Route::middleware('studentauth')->get('/dashboard-data', function () {
//     $studentId = session('student');
//     $student = App\Models\Students::find($studentId);

//     return response()->json([
//         'message' => 'Welcome!',
//         'user' => $student,
//     ]);
// });


namespace App\Http\Controllers;

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
    // $students=Students::find(1);
    // return $students->keepnotes;
    // $student=Students::with('keepnotes')->find(2);
    $note=keepnote::with('student')->get();
    // return $note->student;
    // return $student;
    return view('students.allstudents',[
        'students'=>$note
    ]);
    // return $student;
    // $student=Students::with('keepnotes')->get();
    // $student=Students::with('keepnotes')->find(1);
//   $note=keepnote::with('student')->get();
//   for ($i=0; $i <$note ; $i++) { 
//     return $note[$i]['student'];
//   }
    // return $note[0]->student;
}

    public function signup(){
      
    return view('students.signup');
    
}


// return json_encode([
//             'status'=>'201',
//             'msg'=>'Signup connected'
//         ]); 

public function createbio(Request $req){
$update=Students::where('student_id',$req->student_id)->update([
    'bio'=>$req->bio
   ]);
   if($update){
     return json_encode([
            'status'=>200,
            'msg'=>'Bio Created'
        ]);
   }
else{

    return json_encode([
               'status'=>201,
               'msg'=>'Something went wrong, try again!'
           ]);
}

}

public function editname(Request $req){
$update=Students::where('student_id',$req->student_id)->update([
    'fullname'=>$req->fullname
   ]);
   if($update){
     return json_encode([
            'status'=>200,
            'msg'=>'Name updated'
        ]);
   }
else{

    return json_encode([
               'status'=>201,
               'msg'=>'Something went wrong, try again!'
           ]);
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
            'msg'=>'Saves successfully'
        ]);
        // return redirect('/login');
       }
    }
    // $user=new Students;
    // return 'Saved';
  }
    
}
public function login(){
    return view('students.login');
}

public function createlogin(Request $req){
    $validation=Validator::make($req->all(),[
        'email'=>'required|email',
        'password'=>'required|min:3',
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
        
// return redirect()->route('dashboard')->with('msg', 'Login successful!');

        session(['student'=>$student]);
            //   $req->session()->put('student', $student->student_id);
        return json_encode([
            'status'=>206,
            'msg'=>'User found',
            // 'student'=>$student,
            'userid'=>$student->student_id,
            'profilepicture'=>$student->profilepicture,
            'fullname'=>$student->fullname,
            'phonenumber'=>$student->phonenumber
        ]);
//         session(['student' => $student]);

// return redirect('/dashboard');
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
// public function allusers(Request $req){
//     $allstudents=Students::whereNotIn('student_id',[$req->student_id])->with(['followers'])->get();
//     return json_encode([
//             'status'=>'200',
//             'allstudents'=>$allstudents
//         ]);
// }

public function alluser(Request $req)
{







    
    // $currentUserId = $req->student_id;

    // $allstudents = Students::where('student_id', '!=', $currentUserId)
    //     ->withCount(['followers as is_following' => function ($query) use ($currentUserId) {
    //         $query->where('followers.following_id', $currentUserId);
    //             //   ->where('status', 1);
    //     }])
    //     ->get();
    
 
    // $currentUserId = $req->student_id;

    // $students = Students::where('student_id', '!=', $currentUserId)->get();
 //where('follower_id', $student->student_id)
    // Loop through each student and check if they follow the current user
    // $isFollowing=[];
    // $studentsWithStatus = $students->map(function ($student) use ($currentUserId) {
        // $isFollowing = Followers::where('follower_id', $currentUserId)
            // ->where('following_id', $currentUserId)
            // ->where('status', 1)
            // ->exists();

    //  $student->follow_status = $isFollowing ? 'follow' : 'unfollow';
    // //    return $student;
    //     return response()->json(
    //         ['checkfollow'=>$isFollowing]
    //     );
    // });

    // return response()->json([
    //     'status' => '200',
    //     'allstudents' => $studentsWithStatus,
    //     'student'=>$students,
    //     'foll'=>$isFollowing
    // ]);



    // return response()->json([
    //     'status' => '200',
    //     'allstudents' => $allstudents
    // ]);
}


// public function allusers(Request $req)
// {
//     $currentUserId = $req->student_id;

//     // Get all users the current user is following
//     $followingList = Followers::where('follower_id', $currentUserId)
//         ->with('following') // eager load the following user data
//         ->get()
//         ->map(function ($follower) {
//             return [
//                 'student_id' => $follower->following->student_id,
//                 'fullname' => $follower->following->fullname,
//                 'email' => $follower->following->email,
//                 'profilepicture' => $follower->following->profilepicture,
//                 'phonenumber' => $follower->following->phonenumber,
//             ];
//         });

//     return response()->json([
//         'status' => '200',
//         'following' => $followingList
//     ]);
// }
public function allusers(Request $req)
{
    $currentUserId = $req->student_id;

    
    $otherStudents = Students::where('student_id', '!=', $currentUserId)->get();

    
    $follows = Followers::where('follower_id', $currentUserId)->get();

    
    $followStatusMap = [];
    foreach ($follows as $f) {
        $followStatusMap[$f->following_id] = $f->status;
    }

    
    $studentsWithStatus = $otherStudents->map(function ($student) use ($followStatusMap) {
        $student->follow_status = $followStatusMap[$student->student_id] ?? 'unfollow';
        return $student;
    });

    return response()->json([
        'status' => '200',
        'students' => $studentsWithStatus
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
public function getcurrentstudent(Request $req){
     $student=Students::where('student_id',$req->id)->first();
     if($student){
        return response()->json([
            'status' => 200,
            'student'=>$student
            
        ]);
     }
     else{
        return response()->json([
            'status' => 201,
            'msg'=>'Not found'
            
        ]);
     }
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
public function studentprofilepicture(Request $req){
    if($req->hasFile('image') && $req->student_id){

        $newname=time().$req->file('image')->getClientOriginalName();
        $move=$req->file('image')->move(public_path('profilepictures'),$newname);
        if($move){
        $profilepicture=Students::where('student_id',$req->student_id)->update([
            'profilepicture'=>$newname
        ]);
        
        if($profilepicture){
         return json_encode([
            'status'=>'200',
            'msg'=>'Profile picture uploaded successfully'
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
return json_encode($req->file('image'));
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
public function allnotes($id){
    $student=Students::where('student_id',$id)->first();
    return view('students.allnotes',[
        'allnotes'=>$student->keepnotes
    ]);
}
public function notestudent($id){
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
}

