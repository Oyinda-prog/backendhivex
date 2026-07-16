@extends('students.index')
@section('content')
    <div class="col-6 mx-auto shadow">
<h1 class="text-primary">Sign up page</h1>
<form action="/createstudent" method="POST">
    @csrf
    <input type="text" placeholder="Fullname" class="form-control my-2" name="fullname">
    <input type="text" placeholder="Email" class="form-control my-2" name="email" ful>
    <input type="text" placeholder="Password" class="form-control my-2" name="password">
    <input type="submit" value="Sign up" class="btn btn-primary w-100 py-2 my-2">
</form>
{{-- <p><a href="forgotpassword">forgot password?</a></p> --}}
    </div>
    @foreach ($errors->all() as $error)
        <p>{{$error}}</p>
    @endforeach
    @if (isset($error))
    <p>{{$error}}</p>
    @endif
@endsection

