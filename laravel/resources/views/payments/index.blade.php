@extends('layouts.payments')

@section('content')
    <div class="container">
        <div class="mt-3 mb-4">
            <h1>Payments List</h1>
            <a href="{{ route('payments.create') }}" class="btn btn-success">Create a new payment</a>
        </div>

        <form method="GET" action="{{ route('payments.index') }}" class="row g-3 mb-4">
            <div class="col-md-2">
                <label for="rental_id">Rental ID</label>
                <input type="number" name="rental_id" class="form-control" placeholder="id"
                    value="{{ request('rental_id') }}">
            </div>

            <div class="col-md-2">
                <label for="amount">Amount</label>
                <input type="number" name="amount" class="form-control" placeholder="Amount"
                    value="{{ request('amount') }}">
            </div>

            <div class="col-md-1">
                <label for="status">Status</label>
                <select name="status" class="form-select">
                    <option value="">Any</option>
                    <option value="paid" {{ request('status') === 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="unpaid" {{ request('status') === 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                </select>
            </div>

            <div class="col-md-2">
                <label for="payment_date">Payment Date</label>
                <input type="date" name="payment_date" class="form-control" value="{{ request('payment_date') }}">
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
                <a href="{{ route('payments.index') }}" class="btn btn-secondary w-100">Reset</a>
            </div>
        </form>

        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Rental ID</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Payment Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($payments as $payment)
                    <tr>
                        <td>{{ $payment->id }}</td>
                        <td>{{ $payment->rental_id }}</td>
                        <td>{{ $payment->amount }}</td>
                        <td>{{ ucfirst($payment->status) }}</td>
                        <td>{{ $payment->payment_date }}</td>
                        <td class="d-flex">
                            <a href="{{ route('payments.edit', $payment->id) }}" class="btn btn-info btn-sm w-100 mb-1">Edit</a>
                            <form action="{{ route('payments.destroy', $payment->id) }}" method="POST" class="mb-1 w-100"
                                onsubmit="return confirm('Are you sure you want to delete this payment?');">
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
            {{ $payments->links() }}
        </div>
    </div>
@endsection