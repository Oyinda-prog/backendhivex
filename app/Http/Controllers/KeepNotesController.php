<?php

namespace App\Http\Controllers;

use App\Models\keepnote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KeepNotesController extends Controller
{
    public function keepnote($id){
    return view('students.keepnote',['id'=>$id]);
    }
    public function postkeepnote(Request $req,$id){
        $validation=Validator::make($req->all(),[
          'title'=>'required',
          'description'=>'required'
        ]);
       if($validation->fails()){
     return view('students.keepnote',['msg'=>'Validation Fails']);
       }
       else{
        $keep=new keepnote;
        $keep->title=$req->title;
        $keep->description=$req->description;
        $keep->student_id=$id;
        $save=$keep->save();
        if($save){
            return 'saves';
        }
        else{
            return 'failed';
        }
       }
        }
        public function displaykeepnote($id){
            $allnotes=keepnote::where('student_id',$id)->get();
            return view('students.displaykeepnote',['allnotes'=>$allnotes]);
            }
            // public function allkeepnote($id){
            //     return view('students.keepnote',['id'=>$id]);
            //     }
}
