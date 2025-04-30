@extends('layouts.payments')

@section('content')
    <div class="container">
        <div class="mt-3">
            <h1>Payments List</h1>
            <a href="{{ route('payments.create') }}">Create a new payment</a>
        </div>

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
    </div>
@endsection