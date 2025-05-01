@extends('layouts.rentals')

@section('content')
    <div class="container">
        <div class="mt-3 mb-4">
            <h1>Rentals List</h1>
            <a href="{{ route('rentals.create') }}" class="btn btn-success">Create a new rental</a>
        </div>

        <form method="GET" action="{{ route('rentals.index') }}" class="row g-3 mb-4">
            <div class="col-md-2">
                <label for="customer_id">Customer</label>
                <select name="customer_id" class="form-select">
                    <option value="">Select Customer</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" {{ request('customer_id') == $customer->id ? 'selected' : '' }}>
                            {{ $customer->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <label for="car_id">Car</label>
                <select name="car_id" class="form-select">
                    <option value="">Select Car</option>
                    @foreach($cars as $car)
                        <option value="{{ $car->id }}" {{ request('car_id') == $car->id ? 'selected' : '' }}>
                            {{ $car->brand }} {{ $car->model }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <label for="start_date">Start Date</label>
                <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
            </div>

            <div class="col-md-2">
                <label for="end_date">End Date</label>
                <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
            </div>

            <div class="col-md-2">
                <label for="total_price">Total Price</label>
                <input type="number" name="total_price" class="form-control" placeholder="Total Price"
                    value="{{ request('total_price') }}">
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

            <div class="col-md-1 d-flex align-items-center mt-4">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
            <div class="col-md-1 d-flex align-items-center mt-4">
                <a href="{{ route('rentals.index') }}" class="btn btn-secondary w-100">Reset</a>
            </div>
        </form>



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
        <div class="d-flex justify-content-center mt-4">
            {{ $rentals->links() }}
        </div>
    </div>
@endsection