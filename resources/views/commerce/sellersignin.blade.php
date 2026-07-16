@extends('commerce.index')

@section('content')
<div class="container"> 
    <div class="col-8 mx-auto shadow">
        <div class="shadow p-4 m-4">
            <h1 class="text-center  text-info">E commerce seller signin</h1>
      <form action="/commercesignin" method="post" >
        @csrf
        <input type="text" name="email" class="form-control my-2" placeholder="Enter email">
        <input type="password" name="password" class="form-control my-2" placeholder="Enter password">
        <button type="submit" class="btn btn-primary w-100">Signin page</button>
      </form>
        </div>
    
    </div>
    </div>   
@endsection

