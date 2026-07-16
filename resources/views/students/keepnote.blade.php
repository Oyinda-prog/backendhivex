@extends('students.index')

@section('content')
    <div class="col-6 mx-auto shadow p-5">
        <h1 class="text-center text-primary">Create Notes</h1>
        <form action="/keepnote/{{$id}}" method="post">
            @csrf
        <input type="text" name="title" class="form-control my-2" placeholder="Enter Title">
        <textarea name="description" id="" cols="30" rows="10" class="form-control my-2" placeholder="Enter note......"></textarea>
        <div class="text-center">
            <button class="btn btn-outline-dark"  name="submit">Create Note</button>
            <button class="btn btn-outline-primary"><a href="/displaykeepnote/{{$id}}" class="nav-link">Display Notes</a></button>
        </div>
    </form>
    </div>
@endsection