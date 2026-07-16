@extends('todos.index')

@section('content')
   <div class="text-center">hello</div> 
   <form action="/studentssignup">
    <input type="text" placeholder="Fullname">
    <input type="text" placeholder="Email">
    <input type="text" placeholder="Password">
   </form>
@endsection