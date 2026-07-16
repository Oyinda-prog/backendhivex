@extends('students.index')

@section('content')
    <div class="col-5 mx-auto shadow p-4">
        @if (isset($studentid))
        {{-- <p>{{$studentid}}</p> --}}
        <h3 class="text-center text-primary">Create New Password</h3>
        <form action="/forgotpassword" method="post">
            @csrf
            <input type="hidden" name="id" value="{{$studentid}}">
            <input type="text" size="20" name="passwordone" placeholder="Enter Password" class="form-control my-3">
            <input type="text" size="20" name="passwordtwo" placeholder="Confirm Password" class="form-control my-3">
            <div class="text-center">
                <input type="submit" name="submit" value="Create new password" class="btn btn-outline-primary">
            </div>
        </form>
        @endif
        @if (session('success'))
            <p class="text-danger text-center">{{session('success')}}</p>     
        @endif
        

    </div>
@endsection