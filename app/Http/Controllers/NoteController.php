<?php

namespace App\Http\Controllers;

use App\Models\keepnote;
use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function createnote(){
        return view('notes.createnote');
      
    }
    public function savenote(Request $req){
        // dd($req);
          //  return time().$req->image->getClientOriginalName();

// $newname=time().$req->image->getClientOriginalName();
// $move=$req->image->move(public_path('image'),$newname);
// if($move){

//     $notes=new Note;
//     $notes->title=$req->title;
//     $notes->content=$req->content;
//     $notes->image=$newname;
//     $notes->save();
//     return redirect('/displaynote');
   
// }
// else{
//     return 'not moved';
// }
    $notes=new keepnote;
    $notes->title=$req->title;
    $notes->description=$req->content;
    // $notes->image=$newname;
    $notes->save();
    return redirect('/displaynote');
   
    }

    public function displaynote(){
      $allnotes=Note::all();
  
      return view('notes.displaynote',[
        'allnotes'=>$allnotes
      ]);
    
    }
}
