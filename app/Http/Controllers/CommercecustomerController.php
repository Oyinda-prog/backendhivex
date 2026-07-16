<?php

namespace App\Http\Controllers;

use App\Models\ecommmerceproduct;
use Illuminate\Http\Request;

class CommercecustomerController extends Controller
{
    public function dashboard(){
        $allproducts=ecommmerceproduct::all();
        return view('commerce.customerdashboard',[
            'allproducts'=>$allproducts
        ]);
    }
}
