@extends('commerce.index')

@section('content')
<div class="container"> 
    <div class="col-8 mx-auto shadow">
        <div class="shadow p-4 m-4">
            <h1 class="text-center  text-info">Seller Dashbaord</h1>
            <h1 class="text-center  text-info">Upload product </h1>
           
      <form action="/productcreate" method="post" enctype="multipart/form-data">
        @csrf
        <input type="text" name="name" class="form-control my-5" placeholder="Enter product name">
        <textarea name="description" id="" cols="30" rows="10" placeholder="Describe the product" class="form-control"></textarea>
        <input type="quantity" name="quantity" id="" class="form-control my-2">
        <input type="number" name="price" class="form-control my-2" placeholder="Enter Amount">
        <input type="file" name="image" class="form-control my-2">
        <button type="submit" class="btn btn-primary w-100">Save Product</button>
      </form>
        </div>
    
    </div>
    </div>  
    <div class="container mt-5">
        <div class="row shadow p-3 mx-4">
      @foreach ($allproducts as $product)
    
    <div class="col-3">{{$product->name}}</div>
      <div class="col-3">{{$product->description}}</div>
      
      <div class="col-3"><a href=""><button class="btn btn-success">view</button></a></div>
      <div class="col-3"><img src="" alt=""></div>
     
      @endforeach
        </div>
        </div>  
@endsection

