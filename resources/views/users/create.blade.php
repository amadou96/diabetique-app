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

        <form action="{{ route('users.store') }}" method="POST" id="userForm">

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
                <select name="role" class="form-control" required id="roleSelect">
                    <option value="infirmier" {{ old('role', 'infirmier') === 'infirmier' ? 'selected' : '' }}>Infirmier</option>
                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            {{-- Structure : obligatoire pour infirmier --}}
            <div class="mb-3" id="structureField">
                <label class="form-label">Structure de rattachement <span class="text-danger">*</span></label>
                <select name="structure" class="form-control" id="structureSelect">
                    <option value="">-- Choisir la structure --</option>
                    @foreach(['Centre Sante Sangalkam','Centre Sante Rufisque','Centre Sante Colobane','Centre Diabetique Rufisque','Clinique NABY','A Domicile'] as $s)
                        <option value="{{ $s }}" {{ old('structure') === $s ? 'selected' : '' }}>{{ $s }}</option>
                    @endforeach
                </select>
                <small class="text-muted">L'infirmier ne verra que les patients de cette structure.</small>
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

<script>
    const roleSelect = document.getElementById('roleSelect');
    const structureField = document.getElementById('structureField');
    const structureSelect = document.getElementById('structureSelect');

    function toggleStructure() {
        if (roleSelect.value === 'infirmier') {
            structureField.style.display = '';
            structureSelect.required = true;
        } else {
            structureField.style.display = 'none';
            structureSelect.required = false;
        }
    }

    roleSelect.addEventListener('change', toggleStructure);
    toggleStructure(); // init
</script>

@endsection
