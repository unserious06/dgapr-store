<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">Categories</h2>
    </x-slot>

    <div class="container py-4">
        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary mb-3">+ Add Category</a>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <ul class="list-group">
            @foreach ($categories as $category)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>{{ $category->name }}</span>
                    <div>
                        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-secondary">Edit</a>
                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this category?')">Delete</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
        {{--<div class="mt-4">
            {{ $categories->links() }}
        </div>--}}
    </div>
</x-app-layout> 

    {{--@section('content')
        <h1>Categories</h1>

        <a href="{{ route('admin.categories.create') }}">+ Add Category</a>

        @if (session('success'))
            <div>{{ session('success') }}</div>
        @endif

        <ul>
            @foreach ($categories as $category)
                <li>
                    {{ $category->name }}

                    <a href="{{ route('admin.categories.edit', $category) }}">Edit</a>

                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Delete this category?')">Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @endsection
  --}}
