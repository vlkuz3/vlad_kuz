@extends('layouts.cars')

@section('content')
    <div class="container">
        <div class="mt-3 mb-4">
            <h1>Cars List</h1>
            <a href="{{ route('cars.create') }}" class="btn btn-success">Create a new car</a>
        </div>

        <form method="GET" action="{{ route('cars.index') }}" class="row g-3 mb-4">
            <div class="col-md-2">
                <label for="brand">Brand</label>
                <input type="text" name="brand" class="form-control" placeholder="Brand" value="{{ request('brand') }}">
            </div>
            <div class="col-md-2">
                <label for="model">Model</label>
                <input type="text" name="model" class="form-control" placeholder="Model" value="{{ request('model') }}">
            </div>
            <div class="col-md-2">
                <label for="color">Color</label>
                <input type="text" name="color" class="form-control" placeholder="Color" value="{{ request('color') }}">
            </div>
            <div class="col-md-1">
                <label for="year">Year</label>
                <input type="number" name="year" class="form-control" placeholder="Year" value="{{ request('year') }}">
            </div>
            <div class="col-md-2">
                <label for="category">Category</label>
                <select name="category_id" class="form-select">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label for="price_per_day">Price Per Day</label>
                <input type="number" name="price_per_day" class="form-control" placeholder="Price"
                    value="{{ request('price_per_day') }}">
            </div>
            <div class="col-md-1">
                <label for="is_available">Is Available</label>
                <select name="is_available" class="form-select">
                    <option value="">Any</option>
                    <option value="1" {{ request('is_available') === '1' ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ request('is_available') === '0' ? 'selected' : '' }}>No</option>
                </select>
            </div>
            <div class="col-md-2 mb-4">
                <label for="itemsPerPage">Items per page</label>
                <select name="itemsPerPage" class="form-select">
                    @foreach ([5, 10, 15, 20] as $size)
                        <option value="{{ $size }}" {{ request('itemsPerPage', 10) == $size ? 'selected' : '' }}>
                            {{ $size }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-1 d-flex align-items-center">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
            <div class="col-md-1 d-flex align-items-center">
                <a href="{{ route('cars.index') }}" class="btn btn-secondary w-100">Reset</a>
            </div>
        </form>


        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="col-1">ID</th>
                    <th class="col-1">Brand</th>
                    <th class="col-1">Model</th>
                    <th class="col-1">Color</th>
                    <th class="col-1">Year</th>
                    <th class="col-1">Category</th>
                    <th class="col-1">Price</th>
                    <th class="col-1">Available</th>
                    <th class="col-1">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($cars as $car)
                    <tr>
                        <td>{{ $car->id }}</td>
                        <td>{{ $car->brand }}</td>
                        <td>{{ $car->model }}</td>
                        <td>{{ $car->color }}</td>
                        <td>{{ $car->year }}</td>
                        <td>{{ $car->category->name ?? '—' }}</td>
                        <td>{{ $car->price_per_day }}</td>
                        <td>{{ $car->is_available ? 'Yes' : 'No' }}</td>
                        <td class="d-flex flex-column">
                            <a href="{{ route('car.edit', $car->id) }}" class="btn btn-info btn-sm mb-1">Edit</a>
                            <form action="{{ route('car.destroy', $car->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this car?');">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm w-100">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center mt-4">
            {{ $cars->links() }}
        </div>
    </div>
@endsection