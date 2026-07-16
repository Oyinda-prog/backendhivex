@extends('students.index')

@section('content')
    <div class="col-5 mx-auto shadow p-4">
        <h3 class="text-center text-primary">Confirm Email</h3>
        <form action="/forgot" method="post">
            @csrf
            <input type="text" size="20" name="email" placeholder="Enter Valid email address" class="form-control my-3">
            <div class="text-center">
                <input type="submit" name="submit" value="Verify Email" class="btn btn-outline-primary">
            </div>
        </form>

    </div>
@endsection