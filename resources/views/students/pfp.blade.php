@extends('students.index')
@section('content')
@if (isset($id))
    <p>{{$id}}</p>
@endif
    <div class="col-6 mx-auto shadow">
        <form action="/forgotpasswordprocess" method="post">
            @csrf
        <input type="hidden" value="{{$id}}" class="form-control my-2" name="id">
        <input type="text" placeholder="Enter Password" class="form-control my-2" name="passwordone">
        <input type="text" name="passwordtwo" placeholder="Confirm Password" class="form-control my-2">
    <input type="submit" value="Submit" name="submit" class="form-control my-2">
        </form>

    </div>
@endsection