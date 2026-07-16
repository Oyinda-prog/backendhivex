@extends('contacts.index')

@section('content')
    <div class="container">
       <div class="col-8 mx-auto shadow">
        <h1 class="text-center text-primary">Contact App</h1>
        <form action="/contact" method="POST">
            @csrf
            <input type="text" name="fullname"  class="form-control my-2 shadow-none" placeholder="fullname">
            <input type="text" name="email"  class="form-control my-2 shadow-none" placeholder="email">
            <input type="text" name="phonenumber" class="form-control my-2 shadow-none" placeholder="Phonenumber">
            <input type="submit" name="submit" class="btn btn-outline-primary">

        </form>

       </div>
     </div>


<div class="container mt-5">
    <div class="row shadow p-3 mx-4">
  @foreach ($allcontacts as $contact)

<div class="col-3">{{$contact->fullname}}</div>
  <div class="col-3">{{$contact->phonenumber}}</div>
  <div class="col-3">{{$contact->email}}</div>
  <div class="col-3"><a href="/uniquecontact/{{$contact->contact_id}}" ><button class="btn btn-success">view contact</button></a></div>

 
  @endforeach
    </div>
    </div>   
@endsection
 