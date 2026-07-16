@extends('posts.index')

@section('content')
    <div class="container">
       <div class="col-8 mx-auto shadow">
        <h1 class="text-center text-primary">Post App</h1>
        <form action="/post" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" name="name"  class="form-control my-4" placeholder="Title">
            <input type="text" name="age" id="" class="form-control">
<input type="submit" name="submit">

        </form>

       </div>
     </div>


<div class="container mt-5">
    <div class="row shadow p-3 mx-4">
  @foreach ($allpost as $post)

<div class="col-3">{{$post->name}}</div>
  <div class="col-3">{{$post->age}}</div>
  
  <div class="col-3"><a href="/uniquepost/{{$post->post_id}}" ><button class="btn btn-success">view</button></a></div>
  <div class="col-3"><img src="" alt=""></div>
 
  @endforeach
    </div>
    </div>  
@endsection
 