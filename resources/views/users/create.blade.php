@extends('layouts.app')

@section('content')

<div class="mb-4">
    <h2>Nouvel utilisateur</h2>
</div>

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card shadow-sm">

    <div class="card-body">

        <form action="{{ route('users.store') }}" method="POST">

            @csrf

            <div class="mb-3">
                <label class="form-label">Nom complet</label>
                <input type="text"
                       name="name"
                       class="form-control"
                       value="{{ old('name') }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Adresse email</label>
                <input type="email"
                       name="email"
                       class="form-control"
                       value="{{ old('email') }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Rôle</label>
                <select name="role" class="form-control" required>
                    <option value="infirmier" {{ old('role') === 'infirmier' ? 'selected' : '' }}>Infirmier</option>
                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Mot de passe</label>
                <input type="password"
                       name="password"
                       class="form-control"
                       required minlength="8">
            </div>

            <div class="mb-3">
                <label class="form-label">Confirmer le mot de passe</label>
                <input type="password"
                       name="password_confirmation"
                       class="form-control"
                       required>
            </div>

            <button type="submit" class="btn btn-success">Créer l'utilisateur</button>
            <a href="{{ route('users.index') }}" class="btn btn-secondary ms-2">Annuler</a>

        </form>

    </div>

</div>

@endsection
