<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Admin User') }}
        </h2>
    </x-slot>

    <x-flash-messages />
<div class="container mt-4">
    

    <form action="{{ route('superadmin.admin.update', $admin) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nom</label>
            <input type="text" name="name" class="form-control" value="{{ $admin->name }}" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $admin->email }}" required>
        </div>

        <div class="mb-3">
            <label>Mot de passe (laisser vide pour maintenir le present mdp)</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label>Confirmer le mot de passe</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Mettre a jour</button>
    </form>
</div>

</x-app-layout>