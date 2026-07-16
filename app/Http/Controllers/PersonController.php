<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PersonController extends Controller
{
    public function signup(Request $req){
        return json_decode($req);
    }
}
