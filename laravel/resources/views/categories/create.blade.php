@extends('layouts.categories')

@section('content')
    <div class="container">
        <h1>Create a new category!</h1>
        <form action="{{ route('categories.store') }}" method="POST" class="mb-4">
            @csrf

            <div class="mb-3">
                <label for="name">Category Name</label>
                <input type="text" name="name" required>
            </div>

            <button type="submit" class="btn btn-success">Create Category</button>
        </form>

        <a href="{{ route('categories.index') }}">All categories</a>

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