@extends('students.index')
@section('content')
<div class="col-6 mx-auto shadow p-4">
    <h1 class="text-primary">Login  page</h1>
    <form action="/createlogin" method="POST">
        @csrf
        <input type="text" placeholder="Email" class="form-control my-2" name="email" >
        <input type="text" placeholder="Password" class="form-control my-2" name="password">
        <input type="submit" value="Log In" class="btn btn-primary w-100 py-2 my-2">
    </form>
      <a href="/forgot">Forgot Password?</a>
        </div>
        @foreach ($errors->all() as $error)
            <p class="text-danger">{{$error}}</p>
        @endforeach
        @if (isset($msg))
        <p id="msg">{{$msg}}</p>
 
        @endif
        <script>
       const msg=document.getElementById('msg')
       if(msg){
        setTimeout(() => {
           msg.style.display='none'
        }, 3000);
       }
        </script>
    @endsection
{{-- <script></script> --}}