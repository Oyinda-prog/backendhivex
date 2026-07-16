@extends('students.index')

@section('content')

{{-- <div class="col-6 mx-auto shadow p-4"> --}}
    
@foreach ($students as $student)
    <h2>title: {{ $student->title }}</h2> 
    <h2>Desc: {{$student->description}}</h2>
    <p>{{$student->student->fullname}}</p>

    {{-- @if ($student->keepnotes->isEmpty())
        <p>No notes found.</p>
    @else --}}
        {{-- <ul> --}}
            {{-- @foreach ($student->keepnotes as $note)
                <li>Title: {{ $note->title }}</li>
                <li>Description: {{ $note->description }}</li>  
            @endforeach --}}
        {{-- </ul>
    @endif --}}

    {{-- <hr> --}}
@endforeach
