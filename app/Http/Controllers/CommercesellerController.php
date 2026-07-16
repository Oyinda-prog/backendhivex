<?php
namespace App\Http\Controllers;
session_start();

use App\Models\Commerceproduct;
use App\Models\Commerceseller;
use App\Models\ecommmerceproduct;
use Illuminate\Http\Request;

class CommercesellerController extends Controller
{
    public function signup(){
        return view('commerce.sellersignup');
    }
    public function create(Request $req){
       $seller=new Commerceseller;
       $seller->fullname=$req->fullname;
       $seller->phonenumber=$req->phonenumber;
       $seller->email=$req->email;
       $seller->password=password_hash($req->password,PASSWORD_DEFAULT);
       $seller->save();
       return redirect('/sellersignin');
    }
    public function signin(){
        return view('commerce.sellersignin');
    }
    public function dashboard(){
        return view('commerce.sellerdashboard');
    }
     public function signincreate(Request $req){
        
        $seller=Commerceseller::where('email',$req->email)->first();
        $password=$seller->password;
        if ($seller){
            $passwordverify=password_verify($req->password,$password);
            if($passwordverify){
                $id=$seller->commerceseller_id;
                $_SESSION['seller_id']=$id;
                $allproducts=ecommmerceproduct::where('commerceseller_id',$id)->get();;
                return view('commerce.sellerdashboard',[
                    'allproducts'=>$allproducts
                ]);
            }
            else{
                return 'invalid details entered';
            }
        }
        else{
            return 'no user found with email address';
        }
        // return $seller;
        
    }
}
