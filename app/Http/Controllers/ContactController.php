<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function contact(){
        $allcontacts=DB::table('contacts')->get();
    return view('contacts.createcontact',[
        'allcontacts'=>$allcontacts
    ]);

    }
    public function createcontact(Request $req){
        $contact=DB::table('contacts')->insert([
            'fullname'=>$req->fullname,
            'email'=>$req->email,
            'phonenumber'=>$req->phonenumber
        ]);
        if ($contact){
        return redirect('/contact');
        }
        else{
            return 'not inserted';
        }
    }
    public function uniquecontact($id){
        $uniquecontact=DB::table('contacts')->where('contact_id',$id)->first();
        return $uniquecontact;
    }
}
