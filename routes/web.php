<?php

use App\Http\Controllers\CommercecustomerController;
use App\Http\Controllers\CommerceproductController;
use App\Http\Controllers\CommercesellerController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\KeepNotesController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\TodoController;
use App\Models\Commerceproduct;
use App\Models\Students;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
Route::get('/createnote',[NoteController::class,'createnote']);
Route::get('/pt',function(){
    $name='oyin';
    $age=12;
    return view('pt.first',compact('name','age'));
});
|
*/
Route::get('/', function () {
    return view('new');
});
Route::get('/index',function(){
    return view('index',[
        'address'=>'Ogbomosho',
        'gender'=>'Female',
        'middleName'=>'Funmi'
    ]);

});
Route::get('/firstpage',function(){
    $errormsg='Page not found';
    $msg='Hello everyone';
    return view('firstpage',array(
        'err'=>'Undefined variable',
        'age'=>56
    ));
    // return view('firstpage')->with('firstname','Oyindamola');
    // return view('firstpage',compact('errormsg','msg'));
});






























// Route::post('/createnote',[NoteController::class,'savenote']);
// Route::get('/displaynote',[NoteController::class,'displaynote']);

// Route::get('/todo',[TodoController::class,'createtodo']);
// Route::post('/todo',[TodoController::class,'savetodo']);
// Route::get('/commercesignup',[CommercesellerController::class,'signup']);
// Route::post('/commercesignup',[CommercesellerController::class,'create']);
// Route::get('/commercesignin',[CommercesellerController::class,'signin']);
// Route::post('/commercesignin',[CommercesellerController::class,'signincreate']);
// Route::get('/sellerdashboard',[CommercesellerController::class,'dashboard']);
// Route::post('/productcreate',[CommerceproductController::class,'productcreate']);
// Route::get('/post',[PostController::class,'createpost']);
// Route::post('/post',[PostController::class,'create']);
// Route::get('/uniquepost/{id}',[PostController::class,'uniquepost']);

// Route::get('/customerdashboard',[CommercecustomerController::class,'dashboard']);
// Route::get('/contact',[ContactController::class,'contact']);
// Route::post('/contact',[ContactController::class,'createcontact']);
// Route::get('/uniquecontact/{id}',[ContactController::class,'uniquecontact']);

// Route::post('/deletestudent',[StudentsController::class,'deletestd']);
// Route::get('/displaykeepnote/{id}',[KeepNotesController::class,'allkeepnote']);
// Route::get('/edit/{id}',[StudentsController::class,'editstudent']);
// Route::post('/update/{id}',[StudentsController::class,'updatestudent']);
// Route::get('/forgotpassword',[StudentsController::class,'fp']);
// Route::post('/forgotpassword',[StudentsController::class,'pfp']);
// Route::get('/forgotpasswordprocess',[StudentsController::class,'processpass']);
// Route::post('/forgotpasswordprocess',[StudentsController::class,'processp']);





// Route::get('/new',function(){
//     return view('new');
//     });
// Route::get('/studentsignup',[StudentsController::class,'signup']);
// Route::post('/createstudent',[StudentsController::class,'createstudent']);
// Route::get('/login',[StudentsController::class,'login']);
// Route::get('/dashboard',[StudentsController::class,'dashboard']);
// Route::post('/createlogin',[StudentsController::class,'createlogin']);
// Route::get('/keepnote/{id}',[KeepNotesController::class,'keepnote']);
// Route::post('/keepnote/{id}',[KeepNotesController::class,'postkeepnote']);
// Route::get('/displaykeepnote/{id}',[KeepNotesController::class,'displaykeepnote']);
// Route::post('/deletestudent',[StudentsController::class,'deletestudent']);
// Route::get('/dashboard/{id}',[StudentsController::class,'editstudent']);
// Route::post('/dashboard/{id}',[StudentsController::class,'updatestudent']);
// Route::get('/allnotes/{id}',[StudentsController::class,'allnotes']);
// Route::get('/forgot',[StudentsController::class,'forgotpass']);
// Route::post('/forgot',[StudentsController::class,'forgot']);
// Route::get('/forgotpassword',[StudentsController::class,'forgotpassword'])->name('verifypassword');
// Route::post('/forgotpassword',[StudentsController::class,'verifypassword']);
// Route::get('/allstudentsnotes',[StudentsController::class,'allstudentsnotes'])->name(('allstudentsnotes'));
// Route::get('/allstudents',[StudentsController::class,'allstudents']);
// Route::get('/notestudent/{id}',[StudentsController::class,'notestudent
// ']);







