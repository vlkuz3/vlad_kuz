@extends('layouts.cars')

@section('content')
    <div class="container">
        <h1>Create a new car!</h1>
        <form action="{{ route('car.store') }}" method="POST" class="mb-4">
            @csrf
            <div class="mb-3">
                <div><label for="brand">Brand</label></div>
                <input type="text" name="brand" id="brand" required>
            </div>

            <div class="mb-3">
                <div><label for="model">Model</label></div>
                <input type="text" name="model" id="model" required>
            </div>

            <div class="mb-3">
                <div><label for="color">Color</label></div>
                <input type="text" name="color" id="color" required>
            </div>

            <div class="mb-3">
                <div><label for="year">Year</label></div>
                <input type="number" name="year" min="1900" required>
            </div>

            <div class="mb-3">
                <div><label for="category_id">Category</label></div>
                <select name="category_id" id="category_id" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <div><label for="price_per_day">Price per day</label></div>
                <input type="number" name="price_per_day" required>
            </div>

            <div class="mb-3">
                <label>Available</label>
                <select name="is_available" required>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>

            <div>
                <button type="submit" class="btn btn-success">Create Car</button>
            </div>
        </form>
        <a href="/car/all">All cars</a>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection