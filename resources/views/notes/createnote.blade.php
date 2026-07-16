@extends('notes.index')

@section('content')
    <div class="container">
        <h1>Note app</h1>
<form action="/createnote" method="post" enctype="multipart/form-data">
    @csrf
    <input type="text" name="title" >
    <textarea name="content" id="" cols="30" rows="10"></textarea>
    <input type="file" name="image">
    <input type="hide" name="">
    <input type="submit" name="submit" class="btn btn-primary">
</form>
</div>

@endsection

