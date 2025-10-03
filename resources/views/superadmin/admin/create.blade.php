<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Admin User') }}
        </h2>
    </x-slot>

    <x-flash-messages />

<div class="container mt-4">
    

    <form action="{{ route('superadmin.admin.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nom</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Mot de passe</label>
            <input type="password" name="password" class="form-control" required>
            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Confirmer mot de passe</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Creer Admin</button>
    </form>
</div>

</x-app-layout>