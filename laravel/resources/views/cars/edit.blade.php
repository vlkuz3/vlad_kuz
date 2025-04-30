@extends('layouts.product')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Car</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('car.update', $car->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="brand">Brand</label>
                        <input type="text" name="brand" id="brand" class="form-control"
                            value="{{ old('brand', $car->brand) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="model">Model</label>
                        <input type="text" name="model" id="model" class="form-control"
                            value="{{ old('model', $car->model) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="color">Color</label>
                        <input type="text" name="color" id="color" class="form-control"
                            value="{{ old('color', $car->color) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="year">Year</label>
                        <input type="number" name="year" id="year" class="form-control"
                            value="{{ old('year', $car->year) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="category_id">Category</label>
                        <select name="category_id" id="category_id" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" @if($category->id == $car->category_id) selected @endif>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="price_per_day">Price per day</label>
                        <input type="number" name="price_per_day" id="price_per_day" class="form-control"
                            value="{{ old('price_per_day', $car->price_per_day) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="is_available">Available</label>
                        <select name="is_available" id="is_available" class="form-control" required>
                            <option value="1" {{ old('is_available', $car->is_available) == 1 ? 'selected' : '' }}>Yes
                            </option>
                            <option value="0" {{ old('is_available', $car->is_available) == 0 ? 'selected' : '' }}>No</option>
                        </select>
                    </div>



                    <button type="submit" class="btn btn-primary mt-4">Update</button>
                </form>
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

        </div>
    </div>
@endsection