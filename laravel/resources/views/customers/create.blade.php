@extends('layouts.customers')

@section('content')
    <div class="container">
        <h1>Create a new customer!</h1>
        <form action="{{ route('customers.store') }}" method="POST" class="mb-4">
            @csrf

            <div class="mb-3">
                <label for="name">Name</label>
                <input type="text" name="name" required>
            </div>

            <div class="mb-3">
                <label for="email">Email</label>
                <input type="email" name="email" required>
            </div>

            <div class="mb-3">
                <label for="phone">Phone</label>
                <input type="text" name="phone" required>
            </div>

            <button type="submit" class="btn btn-success">Create Customer</button>
        </form>

        <a href="{{ route('customers.index') }}">All customers</a>

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