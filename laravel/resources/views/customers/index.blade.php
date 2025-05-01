@extends('layouts.customers')

@section('content')
    <div class="container">
        <div class="mt-3 mb-4">
            <h1>Customers List</h1>
            <a href="{{ route('customers.create') }}" class="btn btn-success">Create a new customer</a>
        </div>

        <form method="GET" action="{{ route('customers.index') }}" class="row g-3 mb-4">
            <div class="col-md-2 mb-3">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" placeholder="Name" value="{{ request('name') }}">
            </div>
            <div class="col-md-2 mb-3">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Email" value="{{ request('email') }}">
            </div>
            <div class="col-md-2 mb-3">
                <label for="phone">Phone</label>
                <input type="text" name="phone" class="form-control" placeholder="Phone" value="{{ request('phone') }}">
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
                <a href="{{ route('customers.index') }}" class="btn btn-secondary w-100">Reset</a>
            </div>
        </form>

        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th class="col-1">ID</th>
                    <th class="col-3">Name</th>
                    <th class="col-3">Email</th>
                    <th class="col-2">Phone</th>
                    <th class="col-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                    <tr>
                        <td>{{ $customer->id }}</td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->phone }}</td>
                        <td class="d-flex">
                            <a href="{{ route('customers.edit', $customer->id) }}"
                                class="btn btn-info btn-sm w-100 mb-1">Edit</a>
                            <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" class="mb-1 w-100"
                                onsubmit="return confirm('Are you sure you want to delete this customer?');">
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
            {{ $customers->links() }}
        </div>
    </div>
@endsection