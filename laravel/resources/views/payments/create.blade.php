@extends('layouts.payments')

@section('content')
    <div class="container">
        <h1>Create a new payment!</h1>
        <form action="{{ route('payments.store') }}" method="POST" class="mb-4">
            @csrf

            <div class="mb-3">
                <label for="rental_id">Rental</label>
                <select name="rental_id" class="form-control" required>
                    @foreach($rentals as $rental)
                        <option value="{{ $rental->id }}">
                            Rental #{{ $rental->id }} - {{ $rental->car->brand }} {{ $rental->car->model }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="amount">Amount</label>
                <input type="number" name="amount" step="1" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="status">Status</label>
                <select name="status" required class="form-control">
                    <option value="paid">Paid</option>
                    <option value="unpaid">Unpaid</option>
                    <option value="pending">Pending</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="payment_date">Payment Date</label>
                <input type="date" name="payment_date" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success">Create Payment</button>
        </form>

        <a href="{{ route('payments.index') }}">All payments</a>

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