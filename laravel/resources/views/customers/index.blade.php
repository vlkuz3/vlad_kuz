@extends('layouts.customers')

@section('content')
    <div class="container">
        <div class="mt-3">
            <h1>Customers List</h1>
            <a href="{{ route('customers.create') }}">Create a new customer</a>
        </div>

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
    </div>
@endsection