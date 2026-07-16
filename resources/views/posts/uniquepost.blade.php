@extends('posts.index')

@section('content')

<div class="container mt-5">
    <div class="row shadow p-3 mx-4">
 

<div class="col-3">{{$allpost->name}}</div>
  <div class="col-3">{{$allpost->age}}</div> 

    </div>
    </div>  
@endsection
 