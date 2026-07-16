@extends('students.index')


@section('content')
    
    @if (isset($student))
    <div class="col-6 mx-auto shadow p-3">
        <h1 class="text-center text-primary">Edit Profile Information</h1>
        <form action="/dashboard/{{$student->student_id}}" method="POST">
            @csrf
            <input type="text" placeholder="Email" class="form-control my-2" name="email" value="{{$student->email}}">
            <input type="text" placeholder="Fullname" class="form-control my-2" name="fullname" value="{{$student->fullname}}">
            <input type="submit" value="Log In" class="btn btn-outline-dark w-100 py-2 my-2">
        </form>
    </div> 
    @else
        <p>No student found</p>
    @endif
@endsection