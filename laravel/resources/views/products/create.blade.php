@extends('layouts.product')

@section('content')
    <div class="container">
        <h1>Create a new product!</h1>
        <form action="{{ route('product.store') }}" method="POST" class="mb-4">
            @csrf
            <div class="mb-3">
                <div><label for="name">Name</label></div>
                <input type="text" name="name" id="name" required>
            </div>
            <div class="mb-3">
                <div><label for="price">Price</label></div>
                <input type="number" name="price" id="price" required>
            </div>
            <div>
                <button type="submit" class="btn btn-success">Create Product</button>
            </div>
        </form>
        <a href="/product/all">All products</a>
    </div>
@endsection