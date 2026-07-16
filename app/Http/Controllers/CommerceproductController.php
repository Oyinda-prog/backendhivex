<?php

namespace App\Http\Controllers;
session_start();

use App\Models\ecommmerceproduct;
use Illuminate\Http\Request;

class CommerceproductController extends Controller
{
    public function productcreate(Request $req){
       $id= $_SESSION['seller_id'];
       $newname= time().$req->image->getClientOriginalName();
       $move=$req->image->move(public_path('productimage'),$newname);
       if($move){
           $product=new ecommmerceproduct;
           $product->name=$req->name;
           $product->quantity=$req->quantity;
           $product->image=$newname;
           $product->price=$req->price;
           $product->description=$req->description;
           $product->commerceseller_id=$id;

          $save= $product->save();
          if ($save){
            $message='Successfully uploaded';
              $resp=[];
              $resp['message']='Successfully uploaded';

            $allproducts=ecommmerceproduct::where('commerceseller_id',$id)->get();
            return $allproducts;
            return view('commerce.sellerdashboard',[
                'allproducts'=>$allproducts
            ]);
          }
          else{
            return 'not saved';
          }
       }
       else{
        return 'not moved';
       };
    
 
        
    }
}
