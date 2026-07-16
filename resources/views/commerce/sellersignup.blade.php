@extends('commerce.index')

@section('content')
<div class="container"> 
    <div class="col-8 mx-auto shadow">
        <div class="shadow p-4 m-4">
            <h1 class="text-center  text-info">E commerce seller signup</h1>
      <form action="/commercesignup" method="post" >
        @csrf
        <input type="text" name="fullname" class="form-control my-5" placeholder="Enter fullname">
        <input type="text" name="phonenumber" class="form-control my-2" placeholder="Enter phone number">
        <input type="text" name="email" class="form-control my-2" placeholder="Enter email">
        <input type="password" name="password" class="form-control my-2" placeholder="Enter password">
        <button type="submit" class="btn btn-primary w-100">Signup page</button>
      </form>
        </div>
    
    </div>
    </div>   
@endsection

