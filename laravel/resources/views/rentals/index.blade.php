@extends('layouts.rentals')

@section('content')
    <div class="container">
        <div class="mt-3">
            <h1>Rentals List</h1>
            <a href="{{ route('rentals.create') }}">Create a new rental</a>
        </div>

        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Car</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Total Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rentals as $rental)
                    <tr>
                        <td>{{ $rental->id }}</td>
                        <td>{{ $rental->customer->name }}</td>
                        <td>{{ $rental->car->brand }} {{ $rental->car->model }}</td>
                        <td>{{ $rental->start_date }}</td>
                        <td>{{ $rental->end_date }}</td>
                        <td>{{ $rental->total_price }}</td>
                        <td class="d-flex">
                            <a href="{{ route('rentals.edit', $rental->id) }}" class="btn btn-info btn-sm w-100 mb-1">Edit</a>
                            <form action="{{ route('rentals.destroy', $rental->id) }}" method="POST" class="mb-1 w-100"
                                onsubmit="return confirm('Are you sure you want to delete this rental?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm w-100">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection