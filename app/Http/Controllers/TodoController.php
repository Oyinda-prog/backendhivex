<?php

namespace App\Http\Controllers;

use App\Models\Students;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TodoController extends Controller
{
    public function createtodo(){
        $alltodos=Todo::all();
        // return $alltodos;
        return view('Todos.createTodo',[
           'todos'=>$alltodos 
        ]);
    }
    public function savetodo(Request $req){
        // dd($req);
        $newname=time().$req->image->getClientOriginalName();
        $move=$req->image->move(public_path('images'),$newname);
        if ($move){

               $todo=new Todo;
               $todo->title=$req->title;
               $todo->description=$req->description;
               $todo->image=$newname;
               $todo->save();
                return redirect('/todo');
        }
        else{

            return 'not moved';
        }
    }

    

public function deletestd(Request $req){
    $delete=Students::where('student_id',$req->delete)->first()->delete();
    if($delete){
 return redirect('/login');
    }
//  return $delete;
}

public function editstd(Request $req){
    $student=Students::where('student_id',$req->delete)->first()->delete();
    if($student){
 return redirect('/login');
    }
//  return $delete;
}
public function editstudent($id){
    $student=Students::where('student_id',$id)->value('fullname');
    $student=Students::where('student_id',$id)->select('fullname','email')->first();
    $student=Students::where('student_id',$id)->first();
    return view('students.editstudent',['student'=>$student]);
}
public function updatestudent(Request $req,$id){
    $update=Students::where('student_id',$id)->update([
        'email'=>$req->email,
        'fullname'=>$req->fullname
    ]);
    if($update){
       
       return redirect("/edit/{$id}")->with('msg','updated successfully');
       
    }
   
}
public function fp(){
    return view('students.fp');
}


public function pfp(Request $req){
    $user=Students::where('email',$req->email)->first();
if($user){
session(['id'=>$user->student_id]);
return redirect('/forgotpasswordprocess');
}
else{
    return 'not found';
}
}

public function processpass(){
    $id=session('id');
    return view('students.pfp')->with('id',$id);
}
public function processp(Request $req){
    if($req->passwordone!==$req->passwordtwo){
        return 'enter the same password';
    }
    else{
        $update=Students::where('student_id',$req->id)->update([
            'password'=>Hash::make($req->passwordtwo)]
        );
        
        if($update){
            return $update;
        }
        else{
            return 'fasle';
        }

    }
      // $students=Students::find(1);
    // return $students->keepnotes;
    // return $student->keepnotes;
}
}
