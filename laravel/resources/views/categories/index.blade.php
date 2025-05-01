@extends('layouts.categories')

@section('content')
    <div class="container">
        <div class="mt-3 mb-4">
            <h1>Car Categories</h1>
            <a href="{{ route('categories.create') }}" class="btn btn-success">Create new category</a>
        </div>

        <form method="GET" action="{{ route('categories.index') }}" class="row g-3 mb-4">
            <div class="col-md-2 mb-3">
                <label for="name">Category</label>
                <input type="text" name="name" class="form-control" placeholder="Name" value="{{ request('name') }}">
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
                <a href="{{ route('categories.index') }}" class="btn btn-secondary w-100">Reset</a>
            </div>
        </form>

        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td class="d-flex">
                            <a href="{{ route('categories.edit', $category->id) }}"
                                class="btn btn-info btn-sm w-100 mb-1">Edit</a>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="w-100"
                                onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm w-100" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center mt-4">
            {{ $categories->links() }}
        </div>
    </div>
@endsection