@extends('layouts.cars')

@section('content')
    <div class="container">
        <div class="mt-3">
            <h1>Cars List</h1>
            <a href="/car/create">Create a new car</a>
        </div>

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
                        <td>{{ $car->category->name }}</td>
                        <td>{{ $car->price_per_day }}</td>
                        <td>{{ $car->is_available }}</td>
                        <td class="d-flex">
                            <a href="{{ route('car.edit', $car->id) }}" class="btn btn-info btn-sm w-100 mb-1">Edit</a>
                            <form action="{{ route('car.destroy', $car->id) }}" method="POST" class="mb-1 w-100"
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
    </div>
@endsection