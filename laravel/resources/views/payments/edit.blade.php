@extends('layouts.payments')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Payment</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('payments.update', $payment->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>Rental ID</label>
                        <input type="text" class="form-control" disabled value="{{ $payment->rental_id }}">
                    </div>

                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="number" name="amount" id="amount" class="form-control"
                            value="{{ old('amount', $payment->amount) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="paid" {{ old('status', $payment->status) == 'paid' ? 'selected' : '' }}>Paid
                            </option>
                            <option value="unpaid" {{ old('status', $payment->status) == 'unpaid' ? 'selected' : '' }}>Unpaid
                            </option>
                            <option value="pending" {{ old('status', $payment->status) == 'pending' ? 'selected' : '' }}>
                                Pending</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="payment_date">Payment Date</label>
                        <input type="date" name="payment_date" id="payment_date" class="form-control"
                            value="{{ old('payment_date', $payment->payment_date) }}" required>
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