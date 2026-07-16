@extends('students.index')

@section('content')
{{-- <div>hello</div> --}}
<div class="col-6 mx-auto shadow p-4">
    <h2 class="text-center p-4 text-primary">Notes</h2>
    @if ($allnotes->count()>0)
       @foreach ($allnotes as $note)
            <div class="shadow p-3">
                <h3>Title: <i class="text-primary">{{$note->title}}</i></h3>
                <p class="text-justify">Description: {{$note->description}}</p>
                <hr>
            </div>
       @endforeach


       @else
<p>No notes is available</p>
    @endif
   <div class="text-center p-2">
    <button class="btn btn-outline-primary"><a href="/dashboard" class="nav-link">Dashboard</a></button>
   </div>
</div>
    
@endsection