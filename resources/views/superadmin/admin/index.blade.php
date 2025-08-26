<x-app-layout>


    <div class="container mt-4">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Manager') }}
        </h2>
    </x-slot>

    <x-flash-messages />
    <a href="{{ route('superadmin.admin.create') }}" class="btn btn-primary mb-3">Add Admin</a>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th><th>Email</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($admins as $admin)
                <tr>
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->email }}</td>
                    <td>
                        <a href="{{ route('superadmin.admin.edit', $admin) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('superadmin.admin.destroy', $admin) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</x-app-layout>