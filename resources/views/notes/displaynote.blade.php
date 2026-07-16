@extends('notes.index')
@section('content')
<div class="container">
    <h1>display page</h1>
    <div class="row shadow p-3 mx-4">
        <div>hjkkkk</div>

  @foreach ($allnotes as $note)

<div class="col-3">{{$note->title}}</div>
  <div class="col-3">{{$note->content}}</div>
  <div class="col-3" >
    <img src="{{asset('image/'.$note->image)}}" alt="" style="width: 100px; height:100px; border-radius:100%">
  </div>
  <div class="col-3"><button class="btn btn-danger">Delete</button></div>
 
  @endforeach
    </div>
    </div> 
@endsection


