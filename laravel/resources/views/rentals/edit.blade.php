@extends('layouts.rentals')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Rental</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('rentals.update', $rental->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>Car</label>
                        <input type="text" class="form-control" disabled
                            value="{{ $rental->car->brand }} {{ $rental->car->model }}">
                    </div>

                    <div class="form-group">
                        <label>Customer</label>
                        <input type="text" class="form-control" disabled value="{{ $rental->customer->name }}">
                    </div>

                    <div class="form-group">
                        <label for="start_date">Start Date</label>
                        <input type="date" name="start_date" id="start_date" class="form-control"
                            value="{{ old('start_date', $rental->start_date) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="end_date">End Date</label>
                        <input type="date" name="end_date" id="end_date" class="form-control"
                            value="{{ old('end_date', $rental->end_date) }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary mt-4">Update</button>
                </form>

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
        </div>
    </div>
@endsection