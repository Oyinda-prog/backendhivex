@extends('students.index')

@section('content')
<h1>Edit info</h1>
<form action="/update/{{$student->student_id}}" method="POST">
    @csrf
    <input type="text" placeholder="Fullname" class="form-control my-2" name="fullname" value="{{$student->fullname}}">
    <input type="text" placeholder="Email" class="form-control my-2" name="email" value="{{$student->email}}">
    
    <input type="submit" value="Update Student" class="btn btn-success w-100 py-2 my-2">
</form>
@if (session('msg'))
    <p>{{session('msg')}}</p>

    
@endif

@endsection