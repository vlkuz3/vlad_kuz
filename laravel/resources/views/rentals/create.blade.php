@extends('layouts.rentals')

@section('content')
    <div class="container">
        <h1>Create a new rental!</h1>
        <form action="{{ route('rentals.store') }}" method="POST" class="mb-4">
            @csrf

            <div class="mb-3">
                <label for="car_id">Car</label>
                <select name="car_id" required>
                    @foreach($cars as $car)
                        <option value="{{ $car->id }}">{{ $car->brand }} {{ $car->model }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="customer_id">Customer</label>
                <select name="customer_id" required>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="start_date">Start Date</label>
                <input type="date" name="start_date" required>
            </div>

            <div class="mb-3">
                <label for="end_date">End Date</label>
                <input type="date" name="end_date" required>
            </div>

            <button type="submit" class="btn btn-success">Create Rental</button>
        </form>

        <a href="{{ route('rentals.index') }}">All rentals</a>

        @if ($errors->any())
            <div class="alert alert-danger mt-3">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endsection