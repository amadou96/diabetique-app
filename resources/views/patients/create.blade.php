@extends('layouts.app')

@section('content')

<div class="mb-4">
    <h2>Ajouter un patient</h2>
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

        <form action="{{ route('patients.store') }}" method="POST">

            @csrf

            <div class="mb-3">
                <label class="form-label">Numéro de dossier <span class="text-danger">*</span></label>
                <input type="text" name="numero_dossier" class="form-control"
                       value="{{ old('numero_dossier') }}" placeholder="ex : 61" required>
                <small class="text-muted">Doit être unique. Les dossiers existants sont numérotés de 1 à 60.</small>
            </div>

            @if(auth()->user()->isAdmin())
                <div class="mb-3">
                    <label class="form-label">Structure de suivi <span class="text-danger">*</span></label>
                    <select name="structure" class="form-control" required>
                        <option value="">-- Choisir la structure --</option>
                        @foreach(['Centre Sante Sangalkam','Centre Sante Rufisque','Centre Sante Colobane','Centre Diabetique Rufisque','Clinique NABY','A Domicile'] as $s)
                            <option value="{{ $s }}" {{ old('structure') === $s ? 'selected' : '' }}>{{ $s }}</option>
                        @endforeach
                    </select>
                </div>
            @else
                {{-- Infirmier : structure automatiquement assignée --}}
                <div class="mb-3">
                    <label class="form-label">Structure de suivi</label>
                    <input type="text" class="form-control" value="{{ auth()->user()->structure }}" readonly>
                    <small class="text-muted">Le patient sera enregistré dans votre structure.</small>
                </div>
            @endif

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nom <span class="text-danger">*</span></label>
                    <input type="text" name="nom" class="form-control" value="{{ old('nom') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Prénom <span class="text-danger">*</span></label>
                    <input type="text" name="prenom" class="form-control" value="{{ old('prenom') }}" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Date de naissance <span class="text-danger">*</span></label>
                    <input type="date" name="date_naissance" class="form-control" value="{{ old('date_naissance') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Sexe <span class="text-danger">*</span></label>
                    <select name="sexe" class="form-control" required>
                        <option value="Masculin" {{ old('sexe') === 'Masculin' ? 'selected' : '' }}>Masculin</option>
                        <option value="Féminin" {{ old('sexe') === 'Féminin' ? 'selected' : '' }}>Féminin</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Téléphone</label>
                    <input type="text" name="telephone" class="form-control" value="{{ old('telephone') }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Groupe sanguin</label>
                    <input type="text" name="groupe_sanguin" class="form-control" value="{{ old('groupe_sanguin') }}">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Adresse</label>
                <input type="text" name="adresse" class="form-control" value="{{ old('adresse') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Profession</label>
                <input type="text" name="profession" class="form-control" value="{{ old('profession') }}">
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Assuré</label>
                    <select name="assure" class="form-control">
                        <option value="Non" {{ old('assure') === 'Non' ? 'selected' : '' }}>Non</option>
                        <option value="Oui" {{ old('assure') === 'Oui' ? 'selected' : '' }}>Oui</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Niveau de scolarisation</label>
                    <select name="niveau_scolarisation" class="form-control">
                        @foreach(['Non scolarisé','Primaire','Secondaire','Diplomé'] as $n)
                            <option value="{{ $n }}" {{ old('niveau_scolarisation') === $n ? 'selected' : '' }}>{{ $n }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Allergies</label>
                <textarea name="allergies" class="form-control" rows="2">{{ old('allergies') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Antécédents</label>
                <textarea name="antecedents" class="form-control" rows="2">{{ old('antecedents') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Enregistrer</button>
            <a href="{{ route('patients.index') }}" class="btn btn-secondary ms-2">Annuler</a>

        </form>

    </div>
</div>

@endsection
