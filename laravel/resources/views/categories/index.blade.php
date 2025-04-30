@extends('layouts.categories')

@section('content')
    <div class="container">
        <div class="mt-3">
            <h1>Car Categories</h1>
            <a href="{{ route('categories.create') }}">Create new category</a>
        </div>

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
    </div>
@endsection