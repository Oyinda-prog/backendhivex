@extends('students.index')
@section('content')
    <div class="col-6 mx-auto shadow">
        <form action="/forgotpassword" method="post">
            @csrf
        <input type="text" placeholder="Enter email address" class="form-control my-2" name="email">
    <input type="submit" value="Submit" placeholder="Enter email address" class="form-control my-2">
        </form>

    </div>
@endsection