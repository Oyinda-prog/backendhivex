@extends('students.index')

@section('content')
    {{-- <div>dashboard</div> --}}

    <div class="container-fluid mx-auto shadow">
        <h2 class="text-muted text-center">Student&apos;s Dashboard</h2>
        <div class="row">
<div class="col-3 shadow p-2 ">
<a href="/keepnote/{{$students->student_id}}" class="nav-link mb-4">Create notes</a>
<a href="/displaykeepnote/{{$students->student_id}}" class="nav-link mb-4">Display notes</a>
   <a href="#c" class="nav-link mb-4">Home</a>
   <a href="/login" class="nav-link mb-4">Login|</a>
   <a href="/dashboard" class="nav-link mb-4">Dashboard|</a>
   <a href="/studentsignup" class="nav-link mb-4">Signup</a>
   <a href="/allnotes/{{$students->student_id}}" class="nav-link mb-4">All Notes by me!</a>
   <a href="/notestudent/{{$students->student_id}}" class="nav-link mb-4">Note_student!</a>
   
</div>
<div class="col-9 shadow">
    @if (session()->has('student')) {
     student is logged in
}
<p>Email: {{ session('student')->email }}</p>
<p>Name: {{ session('student')->name }}</p>


    @if (isset($students))
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Fullname</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            
                <tr id="C">
                    <td>{{ $students->fullname }}</td>
                    <td>{{ $students->email }}</td>
                    {{-- <td>{{ $students->student_id }}</td> --}}
                    <td>
                    <form action="deletestudent" method="POST">
                        @csrf
                        <input type="hidden" name="student_id" value="{{$students->student_id}}">
                    <input type="submit" value="Delete Account" name="DeleteAccount" class="btn btn-danger">
                    </form> 
                    <button class="btn btn-outline-success m-1">
                        <a href="/dashboard/{{$students->student_id}}" class="nav-link">Update Details</a></button>                                                    
                    </td>
                </tr>
            
        </tbody>
    </table>
</div>

@endif

</div>
        </div>
        
       
@endsection

