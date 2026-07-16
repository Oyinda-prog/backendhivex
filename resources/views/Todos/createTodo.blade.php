@extends('Todos.index')

@section('content')
    <div class="container">
       <div class="col-8 mx-auto shadow">
        <h1 class="text-center text-primary">Todo App</h1>
        <form action="/todo" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" name="title"  class="form-control my-4" placeholder="Title">
            <textarea name="description" cols="30" rows="10" placeholder="Write your todo list....." class="form-control my-2"></textarea>
            <input type="file" name="image" class="form-control my-3">
            <input type="submit" name="submit" class="btn btn-outline-primary w-100 py-2">

        </form>

       </div>
     </div>


<div class="container mt-5">
    <div class="row shadow p-3 mx-4">
  @foreach ($todos as $todo)

<div class="col-3">{{$todo->title}}</div>
  <div class="col-3">{{$todo->description}}</div>
  
  <div class="col-3"><a href=""><button class="btn btn-success">view</button></a></div>
  <div class="col-3"><img src="" alt=""></div>
 
  @endforeach
    </div>
    </div>  
@endsection
 